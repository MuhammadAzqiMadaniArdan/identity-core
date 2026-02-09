<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiResource
{
    public static function successResponse(
        mixed $data = [],
        string $message = "Success",
        int $code = Response::HTTP_OK,
        array $meta = []
    ) : JsonResponse {
        $response = [
            "success" => true,
            "message" => $message,
            "data" => $data,
        ];
        if (!empty($meta)) {
            $response['meta'] = $meta;
        }
        return response()->json($response, $code);
    }
    public static function errorResponse(
        string $message = "Error",
        int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        array $errors = []
    ) : JsonResponse {
        $response = [
            "success" => false,
            "message" => $message
        ];
        if (!empty($errors)) {
            $response['errors'] = $errors;
        }
        return response()->json($response, $code);
    }
}
