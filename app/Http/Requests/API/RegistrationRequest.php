<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegistrationRequest
 *
 * @property string $name
 * @property string $email
 * @property string $username
 * @property string $password
 */

class RegistrationRequest extends CustomFormRequest
{

    public function rules(): array
    {
        return [
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string',
        ];
    }
}
