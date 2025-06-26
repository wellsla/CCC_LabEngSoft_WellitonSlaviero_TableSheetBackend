<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;

class HandlerTest extends TestCase
{
    private Handler $handler;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();

        // Simular uma aplicação Laravel básica
        $app = new Application();
        $this->handler = new Handler($app);

        // Criar uma request simulada para API
        $this->request = Request::create('/api/test', 'GET');
        $this->request->headers->set('Accept', 'application/json');
    }

    public function testAuthenticationExceptionReturnsPortugueseMessage()
    {
        $exception = new AuthenticationException('Unauthenticated');
        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(401, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Não autenticado. Faça login para acessar este recurso.', $content['message']);
        $this->assertNull($content['meta']);
    }

    public function testAuthorizationExceptionReturnsPortugueseMessage()
    {
        $exception = new AuthorizationException('This action is unauthorized');
        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(403, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Acesso negado. Você não tem permissão para realizar esta ação.', $content['message']);
        $this->assertNull($content['meta']);
    }

    public function testModelNotFoundExceptionReturnsPortugueseMessage()
    {
        $exception = new ModelNotFoundException();
        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(404, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Recurso não encontrado. O item solicitado não existe ou foi removido.', $content['message']);
        $this->assertNull($content['meta']);
    }

    public function testNotFoundHttpExceptionReturnsPortugueseMessage()
    {
        $exception = new NotFoundHttpException();
        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(404, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Rota não encontrada. Verifique se o endereço da API está correto.', $content['message']);
        $this->assertNull($content['meta']);
    }

    public function testMethodNotAllowedExceptionReturnsPortugueseMessage()
    {
        $exception = new MethodNotAllowedHttpException(['GET', 'POST']);
        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(405, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Método não permitido. Verifique o método HTTP utilizado na requisição.', $content['message']);
        $this->assertNull($content['meta']);
    }

    public function testTooManyRequestsExceptionReturnsPortugueseMessage()
    {
        $exception = new TooManyRequestsHttpException(60);
        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(429, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Muitas tentativas. Aguarde um momento antes de tentar novamente.', $content['message']);
        $this->assertNull($content['meta']);
    }

    public function testHttpExceptionWithMessageReturnsOriginalMessage()
    {
        $exception = new HttpException(400, 'Custom error message');
        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(400, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Custom error message', $content['message']);
        $this->assertNull($content['meta']);
    }

    public function testHttpExceptionWithoutMessageReturnsPortugueseDefault()
    {
        $exception = new HttpException(409);
        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(409, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Conflito. O recurso já existe ou está em uso.', $content['message']);
        $this->assertNull($content['meta']);
    }

    public function testGenericExceptionReturnsPortugueseMessage()
    {
        $exception = new \Exception('Generic error');
        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(500, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Erro interno do servidor. Tente novamente mais tarde.', $content['message']);
        $this->assertNull($content['meta']);
    }

    public function testResponseStructureIsConsistent()
    {
        $exception = new AuthenticationException('Test');
        $response = $this->handler->render($this->request, $exception);

        $content = json_decode($response->getContent(), true);

        // Verificar se a estrutura da resposta está correta
        $this->assertArrayHasKey('data', $content);
        $this->assertArrayHasKey('message', $content);
        $this->assertArrayHasKey('meta', $content);

        // Verificar se os tipos estão corretos
        $this->assertNull($content['data']);
        $this->assertIsString($content['message']);
        $this->assertNull($content['meta']);
    }

    public function testUniqueConstraintUsernameViolationReturnsPortugueseMessage()
    {
        // Simular uma QueryException com violação de unique constraint para username
        $exception = new QueryException(
            'pgsql',
            'INSERT INTO users (username, email) VALUES (?, ?)',
            ['testuser', 'test@example.com'],
            new \PDOException('SQLSTATE[23505]: Unique violation: 7 ERROR: duplicate key value violates unique constraint "users_username_unique"')
        );

        // Simular errorInfo para PostgreSQL
        $exception->errorInfo = [null, 23505, 'duplicate key value violates unique constraint "users_username_unique"'];

        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(409, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Este nome de usuário já está em uso. Por favor, escolha outro nome de usuário.', $content['message']);
    }

    public function testUniqueConstraintEmailViolationReturnsPortugueseMessage()
    {
        // Simular uma QueryException com violação de unique constraint para email
        $exception = new QueryException(
            'pgsql',
            'INSERT INTO users (username, email) VALUES (?, ?)',
            ['testuser2', 'duplicate@example.com'],
            new \PDOException('SQLSTATE[23505]: Unique violation: 7 ERROR: duplicate key value violates unique constraint "users_email_unique"')
        );

        // Simular errorInfo para PostgreSQL
        $exception->errorInfo = [null, 23505, 'duplicate key value violates unique constraint "users_email_unique"'];

        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(409, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Este endereço de email já está cadastrado. Por favor, use outro email ou faça login com sua conta existente.', $content['message']);
    }

    public function testUniqueConstraintGameNameViolationReturnsPortugueseMessage()
    {
        // Simular uma QueryException com violação de unique constraint para game name
        $exception = new QueryException(
            'pgsql',
            'INSERT INTO games (name, description) VALUES (?, ?)',
            ['Test Game', 'A test game'],
            new \PDOException('SQLSTATE[23505]: Unique violation: 7 ERROR: duplicate key value violates unique constraint "games_name_unique"')
        );

        // Simular errorInfo para PostgreSQL
        $exception->errorInfo = [null, 23505, 'duplicate key value violates unique constraint "games_name_unique"'];

        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(409, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Já existe um jogo com este nome. Por favor, escolha outro nome para o jogo.', $content['message']);
    }

    public function testGenericUniqueConstraintViolationReturnsPortugueseMessage()
    {
        // Simular uma QueryException com violação de unique constraint genérica
        $exception = new QueryException(
            'pgsql',
            'INSERT INTO some_table (field) VALUES (?)',
            ['value'],
            new \PDOException('SQLSTATE[23505]: Unique violation: 7 ERROR: duplicate key value violates unique constraint "some_unique_constraint"')
        );

        // Simular errorInfo para PostgreSQL
        $exception->errorInfo = [null, 23505, 'duplicate key value violates unique constraint "some_unique_constraint"'];

        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(409, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Os dados informados já estão em uso. Por favor, verifique os campos e tente novamente com informações diferentes.', $content['message']);
    }

    public function testNonUniqueQueryExceptionReturnsGenericDatabaseError()
    {
        // Simular uma QueryException que não é violação de unique constraint
        $exception = new QueryException(
            'pgsql',
            'SELECT * FROM non_existent_table',
            [],
            new \PDOException('SQLSTATE[42P01]: Undefined table: 7 ERROR: relation "non_existent_table" does not exist')
        );

        // Simular errorInfo para PostgreSQL (código diferente de 23505)
        $exception->errorInfo = [null, 42001, 'relation "non_existent_table" does not exist'];

        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(500, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Erro no banco de dados. Tente novamente mais tarde.', $content['message']);
    }

    public function testValidationUniqueErrorsReturnPortugueseMessages()
    {
        // Criar um mock do validator com erros de unique validation
        $validator = $this->createMock(\Illuminate\Validation\Validator::class);

        // Simular erros de validação unique para username e email
        $errors = [
            'username' => ['validation.unique'],
            'email' => ['validation.unique']
        ];

        $validator->method('errors')->willReturn(new \Illuminate\Support\MessageBag($errors));

        // Criar ValidationException
        $exception = new ValidationException($validator);

        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(422, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']);
        $this->assertEquals('Dados inválidos. Verifique os campos abaixo e corrija os erros:', $content['message']);

        // Verificar se os erros foram traduzidos para português
        $this->assertArrayHasKey('meta', $content);
        $this->assertArrayHasKey('errors', $content['meta']);

        $translatedErrors = $content['meta']['errors'];

        // Verificar mensagem traduzida para username
        $this->assertArrayHasKey('username', $translatedErrors);
        $this->assertEquals(
            'Este nome de usuário já está em uso. Por favor, escolha outro nome de usuário.',
            $translatedErrors['username'][0]
        );

        // Verificar mensagem traduzida para email
        $this->assertArrayHasKey('email', $translatedErrors);
        $this->assertEquals(
            'Este endereço de email já está cadastrado. Por favor, use outro email ou faça login com sua conta existente.',
            $translatedErrors['email'][0]
        );
    }

    public function testValidationUniqueErrorForUnknownFieldReturnsGenericMessage()
    {
        // Criar um mock do validator com erro de unique validation para campo desconhecido
        $validator = $this->createMock(\Illuminate\Validation\Validator::class);

        // Simular erro de validação unique para um campo não mapeado
        $errors = [
            'unknown_field' => ['validation.unique']
        ];

        $validator->method('errors')->willReturn(new \Illuminate\Support\MessageBag($errors));

        // Criar ValidationException
        $exception = new ValidationException($validator);

        $response = $this->handler->render($this->request, $exception);

        $this->assertEquals(422, $response->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $translatedErrors = $content['meta']['errors'];

        // Verificar mensagem genérica para campo desconhecido
        $this->assertArrayHasKey('unknown_field', $translatedErrors);
        $this->assertEquals(
            'O campo unknown_field já está em uso. Por favor, escolha outro valor.',
            $translatedErrors['unknown_field'][0]
        );
    }
}
