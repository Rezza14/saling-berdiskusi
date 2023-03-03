<?php

namespace App\Http\Requests\Profile;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'old_password' => [
                'required',
            ],
            'new_password' => [
                'required',
                'confirmed',
                'min:8',
                'different:old_password',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Old password is required',
            'new_password.required' => 'New Password is required',
            'new_password.confirmed' => 'New Password confirmed does not match',
            'new_password.min' => 'New Password must be at least 8 character',
            'new_password.different' => 'New password cannot be the same as the old password',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        if (! $this->wantsJson()) {
            $errors = implode(', ', $validator->errors()->all());
            sweetalert($errors, 'error');
        }
        parent::failedValidation($validator);
    }
}
