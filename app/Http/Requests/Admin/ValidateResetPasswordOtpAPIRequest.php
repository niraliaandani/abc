<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateResetPasswordOtpAPIRequest extends FormRequest
{
    /**
    * @return  bool
    */
    public function authorize(): bool
    {
        return true;
    }

    /**
    * @return  array
    */
    public function rules(): array
    {
        return [
            'otp' => ['required'],
        ];
    }
}
