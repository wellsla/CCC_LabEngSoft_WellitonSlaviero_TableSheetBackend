<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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

        return [
            'game_id' => ($isUpdate ? 'sometimes|' : 'required|') . 'integer|exists:games,id',
            'name' => ($isUpdate ? 'sometimes|' : 'required|') . 'string|max:255',
            'description' => 'nullable|string',
            'document_url' => ($isUpdate ? 'sometimes|' : 'required|') . 'string|url',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check if book name is unique within the game
            if ($this->has('game_id') && $this->has('name')) {
                $bookId = $this->route('book') ? $this->route('book')->id : null;
                $exists = \App\Models\Book::where('game_id', $this->game_id)
                    ->where('name', $this->name)
                    ->when($bookId, function ($query) use ($bookId) {
                        return $query->where('id', '!=', $bookId);
                    })
                    ->exists();

                if ($exists) {
                    $validator->errors()->add('name', 'Já existe um livro com este nome neste jogo.');
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
            'game_id.required' => 'O jogo é obrigatório.',
            'game_id.exists' => 'O jogo selecionado não existe.',
            'name.required' => 'O nome do livro é obrigatório.',
            'name.max' => 'O nome do livro não pode ter mais de 255 caracteres.',
            'document_url.required' => 'A URL do documento é obrigatória.',
            'document_url.url' => 'A URL do documento deve ser válida.',
        ];
    }
}
