<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');
        $userId = $this->route('user') ? $this->route('user')->id : null;

        $rules = [
            'username' => ($isUpdate ? 'sometimes|' : 'required|') . 'string|max:255|unique:users,username' . ($userId ? ',' . $userId : ''),
            'name' => ($isUpdate ? 'sometimes|' : 'required|') . 'string|max:255',
            'email' => ($isUpdate ? 'sometimes|' : 'required|') . 'string|email|max:255|unique:users,email' . ($userId ? ',' . $userId : ''),
            'birth_date' => ($isUpdate ? 'sometimes|' : 'required|') . 'date|before:today',
            'avatar_url' => 'nullable|string|url',
            'is_admin' => 'boolean',
            'is_suspended' => 'boolean',
        ];

        // Password is only required for creation
        if (!$isUpdate) {
            $rules['password'] = ['required', Password::min(8)->letters()->numbers()];
        } else {
            $rules['password'] = ['nullable', Password::min(8)->letters()->numbers()];
        }

        return $rules;
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
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'birth_date.required' => 'A data de nascimento é obrigatória.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'birth_date.before' => 'A data de nascimento deve ser anterior a hoje.',
            'avatar_url.url' => 'A URL do avatar deve ser válida.',
            'is_admin.boolean' => 'O status de administrador deve ser verdadeiro ou falso.',
            'is_suspended.boolean' => 'O status de suspensão deve ser verdadeiro ou falso.',
        ];
    }
}
