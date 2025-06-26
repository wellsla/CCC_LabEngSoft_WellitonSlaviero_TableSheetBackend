<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
        $gameId = $this->route('game') ? $this->route('game')->id : null;

        return [
            'name' => ($isUpdate ? 'sometimes|' : 'required|') . 'string|max:255|unique:games,name' . ($gameId ? ',' . $gameId : ''),
            'description' => ($isUpdate ? 'sometimes|' : 'required|') . 'string',
            'version' => ($isUpdate ? 'sometimes|' : 'required|') . 'string|max:50',
            'cover_image_url' => 'nullable|string|url',
            'is_active' => 'boolean',
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
            'name.required' => 'O nome do jogo é obrigatório.',
            'name.unique' => 'Já existe um jogo com este nome.',
            'name.max' => 'O nome do jogo não pode ter mais de 255 caracteres.',
            'description.required' => 'A descrição do jogo é obrigatória.',
            'version.required' => 'A versão do jogo é obrigatória.',
            'version.max' => 'A versão não pode ter mais de 50 caracteres.',
            'cover_image_url.url' => 'A URL da imagem de capa deve ser válida.',
            'is_active.boolean' => 'O status ativo deve ser verdadeiro ou falso.',
        ];
    }
}
