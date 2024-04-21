<?php

namespace App\Modules\Authentication\Handlers\Requests;

use App\I18n\ApiMessages;
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
        $_ = config('i18n.messages');

        return [
            'username.required' => $_['USERNAME_REQUIRED'],
            'username.unique' => $_['USERNAME_UNIQUE'],
            'username.max' => $_['USERNAME_MAX'],
            'first_name.required' => $_['FIRST_NAME_REQUIRED'],
            'first_name.max' => $_['FIRST_NAME_MAX'],
            'last_name.required' => $_['LAST_NAME_REQUIRED'],
            'last_name.max' => $_['LAST_NAME_MAX'],
            'email.required' => $_['EMAIL_REQUIRED'],
            'email.unique' => $_['EMAIL_UNIQUE'],
            'email.max' => $_['EMAIL_MAX'],
            'password.required' => $_['PASSWORD_REQUIRED'],
            'password.confirmed' => $_['PASSWORD_CONFIRMED'],
            'password.min' => $_['PASSWORD_MIN'],
            'password.max' => $_['PASSWORD_MAX']
        ];
    }
}
