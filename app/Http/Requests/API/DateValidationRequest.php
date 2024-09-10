<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 *
 * @property string $from_date
 * @property string $to_date
 */
class DateValidationRequest extends CustomFormRequest
{

    public function rules(): array
    {
        return [
            'from_date' => 'required|date',
            'to_date' => 'required|date'
        ];
    }
}
