<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'max:255', 'min:6', 'max:255' , 'regex:/^[а-яА-ЯёЁ\s]+$/u'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'min:6',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()->min(6)],
        ];
    }

    public function messages(): array
    {
        return [
            'login.regex' => 'Логин должен содержать только кириллические символы.',
            'login.min' => 'Логин должен содержать минимум 6 символов.',
            'login.required' => 'Поле логин обязательно для заполнения.',
            
            'password.min' => 'Пароль должен содержать минимум 6 символов.',
            'password.required' => 'Поле пароль обязательно для заполнения.',
        ];
    }
}
