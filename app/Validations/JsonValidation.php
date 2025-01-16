<?php

namespace App\Validations;

use Seld\JsonLint\JsonParser;
use Seld\JsonLint\ParsingException;

class JsonValidation
{
    /**
     * @param string $jsonString
     * @return void
     * @throws ParsingException
     */
    public static function jsonValidation(string $jsonString): void
    {
        $parser = new JsonParser();
        $parser->parse($jsonString);
    }
}
