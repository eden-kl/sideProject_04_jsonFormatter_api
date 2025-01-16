<?php

namespace App\Exceptions;

use App\Enums\StatusCode;
use Exception;

class HttpRequestCustomException extends Exception
{
    /**
     * @param string $message
     * @param string|null $errorCode
     * @param bool $isPrefix
     */
    public function __construct(string $message, string $errorCode = null, bool $isPrefix = true)
    {
        $errorCode = $errorCode ? StatusCode::from($errorCode)->transformStatusCode() : StatusCode::error->transformStatusCode();
        $message = $isPrefix ? '[System|User]' . $message : $message;
        parent::__construct($message, $errorCode);
    }

    /**
     * @param string $message
     * @return HttpRequestCustomException
     */
    public static function requestFailed(string $message): HttpRequestCustomException
    {
        return new self($message, StatusCode::parameterError->value);
    }
}
