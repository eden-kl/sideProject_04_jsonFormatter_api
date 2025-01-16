<?php

namespace App\Services;

use App\Enums\StatusCode;

class JsonFormatService
{
    const SPACE_GAP = 4;
    /**
     * @param string $jsonString
     * @return array
     */
    public function jsonFormat(string $jsonString): array
    {
        $dataArray = json_decode($jsonString, true);
        $response = $this->createBeautifulJson($dataArray);
        return [
            'status' => StatusCode::allSuccess->value,
            'data' => $response,
        ];
    }

    /**
     * @param array|string $data
     * @param int $rank
     * @return string
     */
    private function createBeautifulJson(array|string $data, int $rank = 0): string
    {
        if (gettype($data) !== 'array') {
            $prefix = str_repeat(' ', $rank * self::SPACE_GAP);
            return $prefix . $data;
        }else{
            $section = '';
            $prefix = str_repeat(' ', $rank * self::SPACE_GAP);
            $section .= $prefix . '{\n';
            $lastArrayKey = array_key_last($data);
            foreach ($data as $key => $value) {
                $section .= $this->createBeautifulJson($value, $rank + 1);
                if ($key !== $lastArrayKey) {
                    $section .= ',';
                }
                $section .= '\n';
            }
            $section .= '}';
            return $section;
        }
    }
}
