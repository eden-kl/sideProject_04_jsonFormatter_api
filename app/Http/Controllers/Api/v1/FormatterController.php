<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\HttpRequestCustomException;
use App\Http\Controllers\Controller;
use App\Validations\HttpRequestValidation;
use Illuminate\Http\Request;

class FormatterController extends Controller
{
    /**
     * @param Request $request
     * @return void
     * @throws HttpRequestCustomException
     */
    public function formatJson(Request $request)
    {
        HttpRequestValidation::checkRequest($request, config('validation_rules.formatJson'));
    }
}
