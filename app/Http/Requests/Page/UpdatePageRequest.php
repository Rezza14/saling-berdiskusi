<?php

namespace App\Http\Requests\Page;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
            ],
            'page-trixFields' => [
                'required',
                'array',
            ],
            'page-trixFields.content' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title field is required',
            'page-trixFields.required' => 'Content is required',
            'page-trixFields.array' => 'Content invalid',
            'page-trixFields.content.required' => 'Content is required',
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

            $this->redirect = route('page.edit', $this->route('page'));
        }
        parent::failedValidation($validator);
    }
}
