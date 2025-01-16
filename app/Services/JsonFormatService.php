<?php

namespace App\Services;

use App\Enums\StatusCode;

class JsonFormatService
{
    /**
     * @param string $jsonString
     * @return array
     */
    public function jsonFormat(string $jsonString): array
    {
        return [
            'status' => StatusCode::allSuccess->value,
            'data' => $jsonString,
        ];
    }
}
