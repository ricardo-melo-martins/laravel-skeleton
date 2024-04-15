<?php

namespace App\Http\Handlers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'max:255', Rule::unique('users', 'username')],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['max:255'],
            'email' => ['required', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required',
            'username.unique' => 'Username is already taken',
            'username.max' => 'Username is too long',
            'first_name.required' => 'First name is required',
            'first_name.max' => 'First name is too long',
            'last_name.required' => 'Last name is required',
            'last_name.max' => 'Last name is too long',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already taken',
            'email.max' => 'Email is too long',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Passwords do not match',
            'password.min' => 'Password is too short',
            'password.max' => 'Password is too long'
        ];
    }
}
