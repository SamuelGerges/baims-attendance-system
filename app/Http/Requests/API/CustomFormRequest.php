<?php

namespace App\Http\Requests\API;

use App\Helpers\ResponsesHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;


class CustomFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [];
    }


    public function failedValidation(Validator $validator)
    {
        if ($this->header("is_api_call") == "yes") {

            $response = ResponsesHelper::returnError(
                Response::HTTP_NOT_ACCEPTABLE,
                $validator->errors()->messages()
            );

            throw new HttpResponseException($response);
        }
    }
}
