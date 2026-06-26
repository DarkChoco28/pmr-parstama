<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Standard API response structure
     */
    public static function success(
        mixed $data = null,
        string $message = 'Success',
        int $code = 200,
        array $meta = []
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'meta' => $meta,
        ], $code);
    }

    /**
     * Error API response structure
     */
    public static function error(
        string $message = 'Error',
        int $code = 400,
        mixed $errors = null,
        array $meta = []
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            'meta' => $meta,
        ], $code);
    }

    /**
     * Paginated response
     */
    public static function paginated(
        \Illuminate\Pagination\Paginator $paginator,
        string $message = 'Success',
        int $code = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $paginator->items(),
            'meta' => [
                'total' => $paginator->total(),
                'count' => $paginator->count(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'total_pages' => $paginator->lastPage(),
                'has_more' => $paginator->hasMorePages(),
            ],
        ], $code);
    }

    /**
     * Created resource response
     */
    public static function created(
        mixed $data,
        string $message = 'Resource created successfully',
        array $meta = []
    ): JsonResponse {
        return self::success($data, $message, 201, $meta);
    }

    /**
     * No content response
     */
    public static function noContent(): JsonResponse
    {
        return response()->json(null, 204);
    }

    /**
     * Not found response
     */
    public static function notFound(
        string $message = 'Resource not found'
    ): JsonResponse {
        return self::error($message, 404);
    }

    /**
     * Validation error response
     */
    public static function validationError(
        array $errors,
        string $message = 'Validation failed'
    ): JsonResponse {
        return self::error($message, 422, $errors);
    }

    /**
     * Unauthorized response
     */
    public static function unauthorized(
        string $message = 'Unauthorized'
    ): JsonResponse {
        return self::error($message, 401);
    }

    /**
     * Forbidden response
     */
    public static function forbidden(
        string $message = 'Forbidden'
    ): JsonResponse {
        return self::error($message, 403);
    }
}
