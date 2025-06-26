<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AuthRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $route = $this->route()->getName() ?? $this->path();

        return match (true) {
            str_contains($route, 'register') || str_contains($route, '/register') => $this->registerRules(),
            str_contains($route, 'login') || str_contains($route, '/login') => $this->loginRules(),
            str_contains($route, 'forgot-password') || str_contains($route, '/forgot-password') => $this->forgotPasswordRules(),
            str_contains($route, 'reset-password') || str_contains($route, '/reset-password') => $this->resetPasswordRules(),
            default => [],
        };
    }

    /**
     * Get validation rules for user registration.
     */
    private function registerRules(): array
    {
        return [
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'birth_date' => 'required|date|before:today',
        ];
    }

    /**
     * Get validation rules for user login.
     */
    private function loginRules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Get validation rules for forgot password.
     */
    private function forgotPasswordRules(): array
    {
        return [
            'email' => 'required|string|email|exists:users,email',
        ];
    }

    /**
     * Get validation rules for reset password.
     */
    private function resetPasswordRules(): array
    {
        return [
            'token' => 'required|string',
            'email' => 'required|string|email|exists:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'O nome de usuário é obrigatório.',
            'username.unique' => 'Este nome de usuário já está em uso.',
            'username.max' => 'O nome de usuário não pode ter mais de 255 caracteres.',
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ter um formato válido.',
            'email.unique' => 'Este email já está em uso.',
            'email.exists' => 'Este email não está cadastrado.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'birth_date.required' => 'A data de nascimento é obrigatória.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'birth_date.before' => 'A data de nascimento deve ser anterior a hoje.',
            'token.required' => 'O token é obrigatório.',
        ];
    }
}
