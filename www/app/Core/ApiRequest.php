<?php

namespace App\Core;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

/**
 * Class ApiRequest.php
 * @package App\Core
 */
class ApiRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            new JsonResponse([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 422)
        );
    }
}
