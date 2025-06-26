<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Illuminate\Database\QueryException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        // Only return JSON for API requests
        if ($request->is('api/*') || $request->expectsJson()) {
            return $this->renderJsonResponse($request, $e);
        }

        return parent::render($request, $e);
    }

    /**
     * Render exception as JSON response with consistent structure.
     */
    protected function renderJsonResponse(Request $request, Throwable $e)
    {
        // Authentication errors (401)
        if ($e instanceof AuthenticationException) {
            return response()->json([
                'data' => null,
                'message' => 'Não autenticado. Faça login para acessar este recurso.',
                'meta' => null
            ], 401);
        }

        // Authorization errors (403)
        if ($e instanceof AuthorizationException) {
            return response()->json([
                'data' => null,
                'message' => 'Acesso negado. Você não tem permissão para realizar esta ação.',
                'meta' => null
            ], 403);
        }

        // Invalid signature errors (403) - for email verification links
        if ($e instanceof InvalidSignatureException) {
            return response()->json([
                'data' => null,
                'message' => 'Link inválido ou expirado. Solicite um novo link de verificação.',
                'meta' => null
            ], 403);
        }

        // Validation errors (422)
        if ($e instanceof ValidationException) {
            $errors = $e->errors();
            $translatedErrors = $this->translateValidationErrors($errors);

            return response()->json([
                'data' => null,
                'message' => 'Dados inválidos. Verifique os campos abaixo e corrija os erros:',
                'meta' => [
                    'errors' => $translatedErrors
                ]
            ], 422);
        }

        // Model not found (404)
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'data' => null,
                'message' => 'Recurso não encontrado. O item solicitado não existe ou foi removido.',
                'meta' => null
            ], 404);
        }

        // Method not allowed (405)
        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'data' => null,
                'message' => 'Método não permitido. Verifique o método HTTP utilizado na requisição.',
                'meta' => null
            ], 405);
        }

        // Too many requests (429)
        if ($e instanceof TooManyRequestsHttpException) {
            return response()->json([
                'data' => null,
                'message' => 'Muitas tentativas. Aguarde um momento antes de tentar novamente.',
                'meta' => null
            ], 429);
        }

        // Not found HTTP exception (404)
        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'data' => null,
                'message' => 'Rota não encontrada. Verifique se o endereço da API está correto.',
                'meta' => null
            ], 404);
        }

        // Database query errors (500)
        if ($e instanceof QueryException) {
            // Check for unique constraint violations
            $errorCode = $e->errorInfo[1] ?? null;
            $errorMessage = $e->getMessage();

            // PostgreSQL unique constraint violation error code is 23505
            // MySQL unique constraint violations contain "Duplicate entry"
            if ($errorCode === 23505 ||
                str_contains($errorMessage, 'unique constraint') ||
                str_contains($errorMessage, 'duplicate key') ||
                str_contains($errorMessage, 'Duplicate entry')) {

                $message = $this->getUniqueConstraintMessage($errorMessage);
                $statusCode = 409; // Conflict

                // Extract field information for better debugging
                $violatedField = $this->extractViolatedField($errorMessage);

                $meta = config('app.debug') ? [
                    'sql' => $e->getSql(),
                    'bindings' => $e->getBindings(),
                    'error_code' => $errorCode,
                    'constraint_type' => 'unique_violation',
                    'violated_field' => $violatedField
                ] : ($violatedField ? ['field' => $violatedField] : null);

            } else {
                $message = 'Erro no banco de dados. Tente novamente mais tarde.';
                $statusCode = 500;

                // In debug mode, show more specific database error
                if (config('app.debug')) {
                    $message = 'Erro no banco de dados: ' . $errorMessage;
                }

                $meta = config('app.debug') ? [
                    'sql' => $e->getSql(),
                    'bindings' => $e->getBindings(),
                    'error_code' => $errorCode
                ] : null;
            }

            return response()->json([
                'data' => null,
                'message' => $message,
                'meta' => $meta
            ], $statusCode);
        }

        // HTTP exceptions (4xx, 5xx)
        if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
            $message = $e->getMessage();

            // Provide default Portuguese messages for common HTTP status codes
            if (empty($message)) {
                $message = match($statusCode) {
                    400 => 'Requisição inválida. Verifique os dados enviados.',
                    401 => 'Não autenticado. Faça login para acessar este recurso.',
                    403 => 'Acesso negado. Você não tem permissão para realizar esta ação.',
                    404 => 'Recurso não encontrado.',
                    405 => 'Método não permitido.',
                    409 => 'Conflito. O recurso já existe ou está em uso.',
                    422 => 'Dados inválidos. Verifique os campos enviados.',
                    429 => 'Muitas tentativas. Aguarde um momento antes de tentar novamente.',
                    500 => 'Erro interno do servidor.',
                    502 => 'Erro no gateway. Tente novamente mais tarde.',
                    503 => 'Serviço indisponível. Tente novamente mais tarde.',
                    default => 'Um erro ocorreu.'
                };
            }

            return response()->json([
                'data' => null,
                'message' => $message,
                'meta' => null
            ], $statusCode);
        }

        // Generic server errors (500)
        $statusCode = 500;
        $message = 'Erro interno do servidor. Tente novamente mais tarde.';

        // In debug mode, show actual error message
        if (config('app.debug')) {
            $message = $e->getMessage() ?: $message;
        }

        return response()->json([
            'data' => null,
            'message' => $message,
            'meta' => config('app.debug') ? [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace()
            ] : null
        ], $statusCode);
    }

    /**
     * Get user-friendly message for unique constraint violations.
     */
    private function getUniqueConstraintMessage(string $errorMessage): string
    {
        // Convert to lowercase for easier matching
        $lowerMessage = strtolower($errorMessage);

        // Check for specific unique constraints and return appropriate messages
        if (str_contains($lowerMessage, 'users_username_unique') ||
            (str_contains($lowerMessage, 'users') && str_contains($lowerMessage, 'username'))) {
            return 'Este nome de usuário já está em uso. Por favor, escolha outro nome de usuário.';
        }

        if (str_contains($lowerMessage, 'users_email_unique') ||
            (str_contains($lowerMessage, 'users') && str_contains($lowerMessage, 'email'))) {
            return 'Este endereço de email já está cadastrado. Por favor, use outro email ou faça login com sua conta existente.';
        }

        if (str_contains($lowerMessage, 'games_name_unique') ||
            (str_contains($lowerMessage, 'games') && str_contains($lowerMessage, 'name'))) {
            return 'Já existe um jogo com este nome. Por favor, escolha outro nome para o jogo.';
        }

        // Check for compound unique constraints (game_id + name combinations)
        if ((str_contains($lowerMessage, 'races') && str_contains($lowerMessage, 'name')) ||
            str_contains($lowerMessage, 'races_game_id_name_unique')) {
            return 'Já existe uma raça com este nome neste jogo. Por favor, escolha outro nome para a raça.';
        }

        if ((str_contains($lowerMessage, 'classes') && str_contains($lowerMessage, 'name')) ||
            str_contains($lowerMessage, 'classes_game_id_name_unique')) {
            return 'Já existe uma classe com este nome neste jogo. Por favor, escolha outro nome para a classe.';
        }

        if ((str_contains($lowerMessage, 'books') && str_contains($lowerMessage, 'name')) ||
            str_contains($lowerMessage, 'books_game_id_name_unique')) {
            return 'Já existe um livro com este nome neste jogo. Por favor, escolha outro nome para o livro.';
        }

        // Check for character sheet unique constraints (user_id + name or user_id + game_id + name)
        if ((str_contains($lowerMessage, 'character_sheets') && str_contains($lowerMessage, 'name')) ||
            str_contains($lowerMessage, 'character_sheets_user_id_name_unique') ||
            str_contains($lowerMessage, 'character_sheets_user_id_game_id_name_unique')) {
            return 'Você já possui uma ficha de personagem com este nome. Por favor, escolha outro nome para sua ficha.';
        }

        // Check for MySQL unique constraint violations (different error format)
        if (str_contains($lowerMessage, 'duplicate entry') && str_contains($lowerMessage, 'for key')) {
            return $this->getMySQLUniqueConstraintMessage($lowerMessage);
        }

        // Generic unique constraint message if we can't identify the specific field
        return 'Os dados informados já estão em uso. Por favor, verifique os campos e tente novamente com informações diferentes.';
    }

    /**
     * Get user-friendly message for MySQL unique constraint violations.
     */
    private function getMySQLUniqueConstraintMessage(string $errorMessage): string
    {
        $lowerMessage = strtolower($errorMessage);

        // MySQL format: "Duplicate entry 'value' for key 'table.constraint_name'"
        if (str_contains($lowerMessage, 'users.username') || str_contains($lowerMessage, 'users_username_unique')) {
            return 'Este nome de usuário já está em uso. Por favor, escolha outro nome de usuário.';
        }

        if (str_contains($lowerMessage, 'users.email') || str_contains($lowerMessage, 'users_email_unique')) {
            return 'Este endereço de email já está cadastrado. Por favor, use outro email ou faça login com sua conta existente.';
        }

        if (str_contains($lowerMessage, 'games.name') || str_contains($lowerMessage, 'games_name_unique')) {
            return 'Já existe um jogo com este nome. Por favor, escolha outro nome para o jogo.';
        }

        if (str_contains($lowerMessage, 'races') && str_contains($lowerMessage, 'name')) {
            return 'Já existe uma raça com este nome neste jogo. Por favor, escolha outro nome para a raça.';
        }

        if (str_contains($lowerMessage, 'classes') && str_contains($lowerMessage, 'name')) {
            return 'Já existe uma classe com este nome neste jogo. Por favor, escolha outro nome para a classe.';
        }

        if (str_contains($lowerMessage, 'books') && str_contains($lowerMessage, 'name')) {
            return 'Já existe um livro com este nome neste jogo. Por favor, escolha outro nome para o livro.';
        }

        if (str_contains($lowerMessage, 'character_sheets') && str_contains($lowerMessage, 'name')) {
            return 'Você já possui uma ficha de personagem com este nome. Por favor, escolha outro nome para sua ficha.';
        }

        // Generic MySQL unique constraint message
        return 'Os dados informados já estão em uso. Por favor, verifique os campos e tente novamente com informações diferentes.';
    }

    /**
     * Translate validation errors to Portuguese.
     */
    private function translateValidationErrors(array $errors): array
    {
        $translatedErrors = [];

        foreach ($errors as $field => $messages) {
            $translatedMessages = [];

            foreach ($messages as $message) {
                // Check if it's a unique validation error
                if ($message === 'validation.unique' || str_contains($message, 'validation.unique')) {
                    $translatedMessages[] = $this->getUniqueValidationMessage($field);
                } else {
                    // Try to translate using Laravel's translation system
                    $translatedMessage = __($message, [], 'pt_BR');

                    // If translation is the same as original, it means no translation was found
                    // Use a generic Portuguese message
                    if ($translatedMessage === $message) {
                        $translatedMessages[] = $this->getGenericValidationMessage($field, $message);
                    } else {
                        $translatedMessages[] = $translatedMessage;
                    }
                }
            }

            $translatedErrors[$field] = $translatedMessages;
        }

        return $translatedErrors;
    }

    /**
     * Get Portuguese message for unique validation errors.
     */
    private function getUniqueValidationMessage(string $field): string
    {
        $messages = [
            'username' => 'Este nome de usuário já está em uso. Por favor, escolha outro nome de usuário.',
            'email' => 'Este endereço de email já está cadastrado. Por favor, use outro email ou faça login com sua conta existente.',
            'name' => 'Este nome já está em uso. Por favor, escolha outro nome.',
        ];

        return $messages[$field] ?? "O campo {$field} já está em uso. Por favor, escolha outro valor.";
    }

    /**
     * Get generic Portuguese validation message.
     */
    private function getGenericValidationMessage(string $field, string $originalMessage): string
    {
        // Map common validation rules to Portuguese
        $ruleMessages = [
            'required' => "O campo {$field} é obrigatório.",
            'email' => "O campo {$field} deve ser um endereço de email válido.",
            'min' => "O campo {$field} deve ter pelo menos o número mínimo de caracteres.",
            'max' => "O campo {$field} não pode exceder o número máximo de caracteres.",
            'confirmed' => "A confirmação do campo {$field} não confere.",
            'string' => "O campo {$field} deve ser uma string.",
            'integer' => "O campo {$field} deve ser um número inteiro.",
            'numeric' => "O campo {$field} deve ser um número.",
            'boolean' => "O campo {$field} deve ser verdadeiro ou falso.",
            'date' => "O campo {$field} deve ser uma data válida.",
            'exists' => "O valor selecionado para {$field} é inválido.",
        ];

        // Try to match the rule from the original message
        foreach ($ruleMessages as $rule => $message) {
            if (str_contains($originalMessage, $rule)) {
                return $message;
            }
        }

        // Fallback to a generic message
        return "O campo {$field} contém um valor inválido.";
    }

    /**
     * Extract the violated field from the error message for better debugging.
     */
    private function extractViolatedField(string $errorMessage): ?string
    {
        $lowerMessage = strtolower($errorMessage);

        // PostgreSQL patterns
        if (preg_match('/unique constraint "([^"]+)"/', $lowerMessage, $matches)) {
            $constraintName = $matches[1];

            // Map constraint names to user-friendly field names
            $fieldMap = [
                'users_username_unique' => 'username',
                'users_email_unique' => 'email',
                'games_name_unique' => 'name',
                'races_game_id_name_unique' => 'name (within game)',
                'classes_game_id_name_unique' => 'name (within game)',
                'books_game_id_name_unique' => 'name (within game)',
                'character_sheets_user_id_name_unique' => 'name (for user)',
                'character_sheets_user_id_game_id_name_unique' => 'name (for user and game)',
            ];

            return $fieldMap[$constraintName] ?? $constraintName;
        }

        // MySQL patterns
        if (preg_match('/duplicate entry .+ for key \'([^\']+)\'/', $lowerMessage, $matches)) {
            $keyName = $matches[1];

            // Handle MySQL key formats like 'users.username' or 'users_username_unique'
            if (str_contains($keyName, '.')) {
                $parts = explode('.', $keyName);
                return end($parts); // Return the field name part
            }

            // Map MySQL constraint names to user-friendly field names
            $fieldMap = [
                'users_username_unique' => 'username',
                'users_email_unique' => 'email',
                'games_name_unique' => 'name',
                'username' => 'username',
                'email' => 'email',
                'name' => 'name',
            ];

            return $fieldMap[$keyName] ?? $keyName;
        }

        // Fallback: try to detect field names from the message
        if (str_contains($lowerMessage, 'username')) {
            return 'username';
        }
        if (str_contains($lowerMessage, 'email')) {
            return 'email';
        }
        if (str_contains($lowerMessage, 'name')) {
            return 'name';
        }

        return null;
    }
}
