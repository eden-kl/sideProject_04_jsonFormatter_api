<?php

namespace App\Formatters\Response;

use App\Enums\StatusCode;
use Symfony\Component\HttpFoundation\Response;

final class StatusMessage
{
    private const CODE_MAPPING = [
        StatusCode::allSuccess->value => [
            'message' => 'Success',
            'httpCode' => Response::HTTP_OK,
        ],
        StatusCode::parameterError->value => [
            'message' => '參數錯誤',
            'httpCode' => Response::HTTP_BAD_REQUEST,
        ],
        StatusCode::jsonSchemeError->value => [
            'message' => 'json格式錯誤',
            'httpCode' => Response::HTTP_OK,
        ],
        StatusCode::error->value => [
            'message' => 'Error',
            'httpCode' => Response::HTTP_OK,
        ],
    ];

    /**
     * @param string|null $code
     * @return string
     */
    public static function getMessage(string $code = null): string
    {
        return self::CODE_MAPPING[$code]['message'];
    }

    /**
     * @param string $code
     * @return string
     */
    public static function getHttpCode(string $code): string
    {
        return self::CODE_MAPPING[$code]['httpCode'];
    }

    /**
     * @param int $code
     * @param bool $isError
     * @return string
     */
    public static function getStatusCode(int $code, bool $isError = true): string
    {
        $code = $isError ? 'E' . $code : (string)$code;
        if (!array_key_exists($code, self::CODE_MAPPING)) {
            $code = StatusCode::error->value;
        }
        return $code;
    }
}
