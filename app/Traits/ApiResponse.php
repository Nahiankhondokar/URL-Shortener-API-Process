<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successApiResponse(mixed $data, string $message = 'Request successful', int $code = 200, array $extra = [])
    {
        return response()->json([
            'message' => $message,
            'status' => true,
            'errors' => null,
            'extra'     => $extra,
            'execution_time' => (float)number_format(microtime(true) - LARAVEL_START, 3),
            'data' => $data,
        ], $code);
    }

    protected function errorApiResponse(string $message = 'An error occurred', int $code = 400, array $errors = null,  array $extra = [])
    {
        return response()->json([
            'message' => $message,
            'status' => false,
            'errors' => $errors,
            'extra' => $extra,
            'execution_time' => (float)number_format(microtime(true) - LARAVEL_START, 3),
            'data' => null,
        ], $code);
    }
}