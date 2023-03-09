<?php

namespace App\Http\Requests\User;

use App\Enums\RoleEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'username' => [
                'required',
                'string',
                'max:255',
            ],
            'image' => [
                'nullable',
                'image',
                'max:2048',
            ],
            'password' => [
                'nullable',
                'min:8',
                'max:255',
                'confirmed',
            ],
            'role_id' => [
                'nullable',
                new Enum(RoleEnum::class),
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
            'username.required' => 'Username is required',
            'usernam.string' => 'Username must be a string',
            'username.max' => 'Username must be less than 255 characters',
            'image.image' => 'User image must be an image',
            'image.max' => 'User image must be less than 2 MB',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password must be less than 255 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'role.enum' => 'Role must be a valid role',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        $this->redirect = route('user.edit', $this->route('user'));
        $errors = implode('<br>', $validator->errors()->all());
        sweetAlert($errors, 'error');
        parent::failedValidation($validator);
    }
}
