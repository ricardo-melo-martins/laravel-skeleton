<?php

namespace App\Modules\Authentication\Handlers\Requests;

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
}
