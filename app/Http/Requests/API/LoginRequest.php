<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

/**
 * Class LoginRequest
 *
 * @property string $username
 * @property string $password
 */

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Return a single error message for all validation errors
        throw new HttpResponseException(
            response()->json([
                'message' => 'The username and password fields are invalid.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    public function messages(): array
    {
        return [
            'username.required' => 'The username and password fields is invalid.',
            'username.string'   => 'The username and password fields is invalid.',
            'username.exists'   => 'The username and password fields is invalid.',
            'password.required' => 'The username and password fields is invalid.',
            'password.string'   => 'The username and password fields is invalid.'
        ];
    }
}
