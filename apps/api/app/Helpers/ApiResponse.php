<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = null, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

    public static function error($message = 'Error', $statusCode = 400, $errors = null)
    {
        $response = [
            'status' => 'error',
            'data' => null,
            'message' => $message
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    public static function created($data = null, $message = 'Created successfully')
    {
        return self::success($data, $message, 201);
    }

    public static function notFound($message = 'Not found')
    {
        return self::error($message, 404);
    }
}