<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\HttpRequestCustomException;
use App\Http\Controllers\Controller;
use App\Validations\HttpRequestValidation;
use App\Validations\JsonValidation;
use Illuminate\Http\Request;
use Seld\JsonLint\ParsingException;

class FormatterController extends Controller
{
    /**
     * @param Request $request
     * @return void
     * @throws HttpRequestCustomException
     * @throws ParsingException
     */
    public function formatJson(Request $request)
    {
        HttpRequestValidation::checkRequest($request, config('validation_rules.formatJson'));
        JsonValidation::jsonValidation($request->input('data.jsonString'));
    }
}
