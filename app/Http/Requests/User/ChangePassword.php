<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Hash;

class ChangePassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Hash::check(request()->old, request()->user()->password);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
