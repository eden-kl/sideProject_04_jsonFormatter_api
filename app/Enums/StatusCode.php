<?php

namespace App\Enums;

enum StatusCode: string
{
    case allSuccess = '0000';
    case parameterError = 'E101';
    case error = 'E999';

    /**
     * @return int
     */
    public function transformStatusCode(): int
    {
        return (int)substr($this->value, 1);
    }
}
