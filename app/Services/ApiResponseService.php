<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponseService
{
    public static function send(string $message, bool $error = false, mixed $data = null, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'error' => $error,
            'data' => $data
        ], $statusCode);
    }
}
