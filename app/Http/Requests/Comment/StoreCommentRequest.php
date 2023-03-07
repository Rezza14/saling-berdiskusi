<?php

namespace App\Http\Requests\Comment;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id,
            'discussion_id' => $this->route('discussion'),
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'exists:users,id',
            ],
            'discussion_id' => [
                'required',
                'exists:discussions,id',
            ],
            'comment' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User field is required',
            'user_id.exists' => 'User not found',
            'discussion_id.required' => 'Discussion field is required',
            'discussion_id.exists' => 'Discussion not found',
            'comment.required' => 'Please write something to send comment',
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

            $this->redirect = route('discussions.show', $this->route('discussions'));
        }
        parent::failedValidation($validator);
    }
}
