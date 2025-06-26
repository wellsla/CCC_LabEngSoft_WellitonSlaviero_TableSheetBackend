<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaceRequest extends FormRequest
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
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check if race name is unique within the game
            if ($this->has('game_id') && $this->has('name')) {
                $raceId = $this->route('race') ? $this->route('race')->id : null;
                $exists = \App\Models\Race::where('game_id', $this->game_id)
                    ->where('name', $this->name)
                    ->when($raceId, function ($query) use ($raceId) {
                        return $query->where('id', '!=', $raceId);
                    })
                    ->exists();

                if ($exists) {
                    $validator->errors()->add('name', 'Já existe uma raça com este nome neste jogo.');
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
            'name.required' => 'O nome da raça é obrigatório.',
            'name.max' => 'O nome da raça não pode ter mais de 255 caracteres.',
        ];
    }
}
