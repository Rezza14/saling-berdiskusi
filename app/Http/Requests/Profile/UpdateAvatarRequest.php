<?php

namespace App\Http\Requests\Profile;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'image',
                'max:2048',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Profile photo not yet selected',
            'image.image' => 'Profile photo must be image',
            'image.max' => 'Profile photo must be less than 2 MB',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        if (! $this->wantsJson()) {
            $errors = implode('<br>', $validator->errors()->all());
            sweetalert($errors, 'error');
        }
        parent::failedValidation($validator);
    }
}
