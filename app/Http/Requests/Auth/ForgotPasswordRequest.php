<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                app()->isProduction() ? 'email:rfc,dns' : 'email',
                'exists:users,email',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.exists' => 'Email not found',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        if (!$this->wantsJson()) {
            $this->redirect = route('forgot-password');
            $errors = implode(', ', $validator->errors()->all());
            sweetalert($errors, 'error');
        }
        parent::failedValidation($validator);
    }
}
