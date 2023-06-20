<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function successResponse(string $message, $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ]);
    }
}
