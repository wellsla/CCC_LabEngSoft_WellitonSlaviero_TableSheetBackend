<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $userId = auth()->id();

        return [
            'username' => 'sometimes|string|max:255|unique:users,username,' . $userId,
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $userId,
            'birth_date' => 'sometimes|date|before:today',
            'avatar_url' => 'nullable|string|url',
            'current_password' => 'required_with:password|string',
            'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Verify current password if new password is provided
            if ($this->filled('password') && $this->filled('current_password')) {
                if (!\Hash::check($this->current_password, auth()->user()->password)) {
                    $validator->errors()->add('current_password', 'A senha atual está incorreta.');
                }
            }
        });
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.unique' => 'Este nome de usuário já está em uso.',
            'username.max' => 'O nome de usuário não pode ter mais de 255 caracteres.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.email' => 'O email deve ter um formato válido.',
            'email.unique' => 'Este email já está em uso.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'birth_date.before' => 'A data de nascimento deve ser anterior a hoje.',
            'avatar_url.url' => 'A URL do avatar deve ser válida.',
            'current_password.required_with' => 'A senha atual é obrigatória para alterar a senha.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
        ];
    }
}
