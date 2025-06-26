<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponseTrait
{
    /**
     * Return a success response.
     */
    protected function successResponse($data = null, string $message = 'Sucesso', array $meta = null, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'meta' => $meta
        ], $statusCode);
    }

    /**
     * Return a success response for created resources.
     */
    protected function createdResponse($data = null, string $message = 'Recurso criado com sucesso'): JsonResponse
    {
        return $this->successResponse($data, $message, null, 201);
    }

    /**
     * Return a success response for updated resources.
     */
    protected function updatedResponse($data = null, string $message = 'Recurso atualizado com sucesso'): JsonResponse
    {
        return $this->successResponse($data, $message);
    }

    /**
     * Return a success response for deleted resources.
     */
    protected function deletedResponse(string $message = 'Recurso removido com sucesso'): JsonResponse
    {
        return $this->successResponse(null, $message);
    }

    /**
     * Return a paginated response.
     */
    protected function paginatedResponse(LengthAwarePaginator $paginator, string $message = 'Dados recuperados com sucesso'): JsonResponse
    {
        return response()->json([
            'data' => $paginator->items(),
            'message' => $message,
            'meta' => [
                'pagination' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page' => $paginator->lastPage(),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                    'has_more_pages' => $paginator->hasMorePages(),
                    'links' => [
                        'first' => $paginator->url(1),
                        'last' => $paginator->url($paginator->lastPage()),
                        'prev' => $paginator->previousPageUrl(),
                        'next' => $paginator->nextPageUrl(),
                    ]
                ]
            ]
        ]);
    }

    /**
     * Return an error response.
     */
    protected function errorResponse(string $message = 'Um erro ocorreu', array $meta = null, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'data' => null,
            'message' => $message,
            'meta' => $meta
        ], $statusCode);
    }

    /**
     * Return a not found response.
     */
    protected function notFoundResponse(string $message = 'Recurso não encontrado'): JsonResponse
    {
        return $this->errorResponse($message, null, 404);
    }

    /**
     * Return an unauthorized response.
     */
    protected function unauthorizedResponse(string $message = 'Não autenticado'): JsonResponse
    {
        return $this->errorResponse($message, null, 401);
    }

    /**
     * Return a forbidden response.
     */
    protected function forbiddenResponse(string $message = 'Acesso negado'): JsonResponse
    {
        return $this->errorResponse($message, null, 403);
    }
}
