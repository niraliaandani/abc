<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterAPIRequest extends FormRequest
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
            'username' => ['string'],
            'password' => ['string'],
            'email' => ['string','unique:users,email'],
            'name' => ['string'],
            'is_active' => ['boolean'],
            'role' => ['integer','required'],
        ];
    }
}
