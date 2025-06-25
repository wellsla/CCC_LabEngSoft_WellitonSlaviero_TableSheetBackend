<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        // Validation errors
        if ($e instanceof ValidationException) {
            return response()->json([
                'data' => null,
                'message' => 'Validation failed',
                'meta' => [
                    'errors' => $e->errors()
                ]
            ], 422);
        }

        // Model not found (404)
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'data' => null,
                'message' => 'Resource not found',
                'meta' => null
            ], 404);
        }

        // Not found HTTP exception
        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'data' => null,
                'message' => 'Endpoint not found',
                'meta' => null
            ], 404);
        }

        // HTTP exceptions (4xx, 5xx)
        if ($e instanceof HttpException) {
            return response()->json([
                'data' => null,
                'message' => $e->getMessage() ?: 'An error occurred',
                'meta' => null
            ], $e->getStatusCode());
        }

        // Generic server errors (500)
        $statusCode = 500;
        $message = 'Internal server error';

        // In debug mode, show actual error message
        if (config('app.debug')) {
            $message = $e->getMessage();
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
}
