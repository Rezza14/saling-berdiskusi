<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => [
                'required',
                app()->isProduction() ? 'email:rfc,dns' : 'email',
                'exists:users,email',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'Token is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.exists' => 'Email not found',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password not same',
            'password.min' => 'Password must be less than 8 character',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        if (!$this->wantsJson()) {
            $this->redirect = route('password.reset', [
                'token' => $this->route('token'),
                'email' => $this->query('email'),
            ]);
            $errors = implode(', ', $validator->errors()->all());
            alert($errors, 'error');
        }
        parent::failedValidation($validator);
    }
}
