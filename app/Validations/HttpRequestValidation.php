<?php

namespace App\Validations;

use App\Exceptions\HttpRequestCustomException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HttpRequestValidation
{
    /**
     * @param Request $request
     * @param array $rules
     * @return void
     * @throws HttpRequestCustomException
     */
    public static function checkRequest(Request $request, array $rules): void
    {
        $validation = Validator::make($request->all(), $rules['rules'], $rules['errorMessages']);
        if ($validation->fails()) {
            $errors = $validation->errors();
            $messages = [];
            foreach ($errors->all() as $errorMsg) {
                $messages[] = $errorMsg;
            }
            throw HttpRequestCustomException::requestFailed(implode(',', $messages));
        }
    }
}
