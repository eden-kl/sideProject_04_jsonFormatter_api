<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\HttpRequestCustomException;
use App\Formatters\Formatter;
use App\Http\Controllers\Controller;
use App\Services\JsonFormatService;
use App\Validations\HttpRequestValidation;
use App\Validations\JsonValidation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Seld\JsonLint\ParsingException;

class FormatterController extends Controller
{
    private JsonFormatService $jsonFormatService;
    private Formatter $formatter;
    public function __construct(JsonFormatService $jsonFormatService, Formatter $formatter)
    {
        $this->jsonFormatService = $jsonFormatService;
        $this->formatter = $formatter;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws HttpRequestCustomException
     * @throws ParsingException
     */
    public function formatJson(Request $request): JsonResponse
    {
        HttpRequestValidation::checkRequest($request, config('validation_rules.formatJson'));
        $jsonString = $request->input('data.jsonString');
        JsonValidation::jsonValidation($jsonString);
        $response = $this->jsonFormatService->jsonFormat($jsonString);
        return $this->formatter->formatResponse($response);
    }
}
