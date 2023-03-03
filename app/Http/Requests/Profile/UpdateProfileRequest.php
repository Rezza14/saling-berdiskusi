<?php

namespace App\Http\Requests\Profile;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'username' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must be less than 255 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email',
            'email.unique' => 'Email is already taken',
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
