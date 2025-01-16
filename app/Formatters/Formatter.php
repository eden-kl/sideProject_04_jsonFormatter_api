<?php

namespace App\Formatters;

use App\Enums\StatusCode;
use App\Formatters\Response\StatusMessage;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Formatter
{
    /**
     * @param $response
     * @return JsonResponse
     */
    public function formatResponse($response): JsonResponse
    {
        $statusCode = $response['status'] ?? StatusCode::error->value;
        $message = $response['message'] ?? StatusMessage::getMessage($statusCode);
        $httpCode = StatusMessage::getHttpCode($statusCode);
        $message = str_replace('\u0000', '', $message);

        $result =  [
            'metadata' =>   [
                "status" => $statusCode,
                "message" => $message,
            ]
        ];

        if ($statusCode === StatusCode::allSuccess->value) {
            if (!empty($response['data'])) {
                $result['data'] = $response['data'];
            }

            $httpCode = Response::HTTP_CREATED;
        }

        $headers = [
            'Content-Type' => 'application/json; charset=utf-8'
        ];
        return response()->json($result, $httpCode, $headers, JSON_UNESCAPED_UNICODE);
    }
}
