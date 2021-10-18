<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAPIRequest extends FormRequest
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
            'email' => ['string','unique:users,email,'.$this->route("user")],
            'name' => ['string'],
            'is_active' => ['boolean'],
             'user_type' => [Rule::in([User::TYPE_ADMIN, User::TYPE_USER])]
        ];
    }
}
