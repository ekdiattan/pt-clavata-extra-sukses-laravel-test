<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class Controller
{
    /**
     * Success response method.
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse($data = null, string $message = '', int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Error response method.
     *
     * @param string $message
     * @param int $code
     * @param mixed $errors
     * @return JsonResponse
     */
    
    protected function errorResponse(string $message = '', int $code = Response::HTTP_BAD_REQUEST, $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    /**
     * Not found response method.
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function notFoundResponse(string $message = 'Resource not found'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_NOT_FOUND);
    }

    /**
     * Unauthorized response method.
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function unauthorizedResponse(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Forbidden response method.
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function forbiddenResponse(string $message = 'Forbidden'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Validation error response method.
     *
     * @param mixed $errors
     * @param string $message
     * @return JsonResponse
     */
    protected function validationErrorResponse($errors, string $message = 'Validation errors'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY, $errors);
    }

    /**
     * Internal error response method.
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function internalErrorResponse(string $message = 'Internal Server Error'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}