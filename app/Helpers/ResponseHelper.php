<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseHelper
{
    /**
     * success response 
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    public static function successResponse(string $message, $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ]);
    }

    /*
     * datatable response
     */
    public static function getResponseForDatatable($draw, $recordsTotal, $recordFiltered, $data, $totalRow = [])
    {
        $json_data = array(
            "draw" => (int)$draw,
            "recordsTotal" => (int)$recordsTotal,
            "recordsFiltered" => $recordFiltered,
            "data" => $data,
        );
        return json_encode($json_data);
    }

    /*
     * Error Message
     */
    public static function errorMessage($message = null, $errors = null)
    {
        return new JsonResponse([
            'key'       => "BAD_REQUEST",
            'message'   => empty($message) ? config("message.400") : $message,
            'errors'    => $errors,
            'timestamp' => now()
        ], Response::HTTP_BAD_REQUEST);
    }
}
