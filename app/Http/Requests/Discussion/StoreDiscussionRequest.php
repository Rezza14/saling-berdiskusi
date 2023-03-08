<?php

namespace App\Http\Requests\Discussion;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreDiscussionRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'exists:users,id',
            ],
            'title' => [
                'required',
            ],
            'tags' => [
                'nullable',
            ],
            'discussion-trixFields' => [
                'required',
                'array',
            ],
            'discussion-trixFields.body' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User field is required',
            'user_id.exists' => 'User not found',
            'title.required' => 'Title field is required',
            'discussion-trixFields.required' => 'Content is required',
            'discussion-trixFields.array' => 'Content invalid',
            'discussion-trixFields.content.required' => 'Content is required',
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

            $this->redirect = route('discussions.create', $this->route('discussions'));
        }
        parent::failedValidation($validator);
    }
}
