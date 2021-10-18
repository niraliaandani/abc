<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BulkCreateUserAPIRequest extends FormRequest
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
            'data.*.username' => ['string'],
            'data.*.password' => ['string'],
            'data.*.email' => ['string','unique:users,email'],
            'data.*.name' => ['string'],
            'data.*.is_active' => ['boolean'],
            'data.*.user_type' => ['required', Rule::in([User::TYPE_ADMIN, User::TYPE_USER])]
        ];
    }
}
