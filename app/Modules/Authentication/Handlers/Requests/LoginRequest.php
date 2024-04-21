<?php

namespace App\Modules\Authentication\Handlers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::exists('users', 'email')],
            'password' => ['required']
        ];
    }

    public function messages(): array
    {
        $_ = config('i18n.messages');

        return [
            'email.required' => $_['EMAIL_REQUIRED'],
            'email.email' => $_['EMAIL_INVALID'],
            'email.exists' => $_['EMAIL_NOTEXISTS'],
            'password.required' => $_['PASSWORD_REQUIRED'],
            'device_name.required' => $_['DEVICE_REQUIRED']
        ];
    }
}
