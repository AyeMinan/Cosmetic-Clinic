<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     return false;
    // }


    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'confirm_password.same' => 'The password and confirm password must match.',
        ];
    }
}
