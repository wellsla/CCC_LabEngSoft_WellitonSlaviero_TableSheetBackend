<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
class CharacterSheetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the body parameters for API documentation.
     *
     * @return array<string, array>
     */
    public function bodyParameters(): array
    {
        return [
            'game_id' => [
                'description' => 'ID do jogo',
                'example' => 1,
            ],
            'race_id' => [
                'description' => 'ID da raça do personagem',
                'example' => 1,
            ],
            'class_id' => [
                'description' => 'ID da classe do personagem',
                'example' => 1,
            ],
            'name' => [
                'description' => 'Nome do personagem',
                'example' => 'Aragorn',
            ],
            'level' => [
                'description' => 'Nível do personagem',
                'example' => 5,
            ],
            'strength' => [
                'description' => 'Atributo Força',
                'example' => 16,
            ],
            'dexterity' => [
                'description' => 'Atributo Destreza',
                'example' => 14,
            ],
            'constitution' => [
                'description' => 'Atributo Constituição',
                'example' => 15,
            ],
            'intelligence' => [
                'description' => 'Atributo Inteligência',
                'example' => 12,
            ],
            'wisdom' => [
                'description' => 'Atributo Sabedoria',
                'example' => 13,
            ],
            'charisma' => [
                'description' => 'Atributo Carisma',
                'example' => 10,
            ],
            'current_hit_points' => [
                'description' => 'Pontos de vida atuais',
                'example' => 45,
            ],
            'max_hit_points' => [
                'description' => 'Pontos de vida máximos',
                'example' => 50,
            ],
            'armor_class' => [
                'description' => 'Classe de armadura',
                'example' => 16,
            ],
            'initiative' => [
                'description' => 'Modificador de iniciativa',
                'example' => 2,
            ],
            'speed' => [
                'description' => 'Velocidade de movimento',
                'example' => 30,
            ],
            'description' => [
                'description' => 'Descrição do personagem',
                'example' => 'Um guerreiro corajoso do norte',
            ],
            'notes' => [
                'description' => 'Anotações sobre o personagem',
                'example' => 'Possui uma espada mágica',
            ],
            'portrait_url' => [
                'description' => 'URL da imagem do personagem',
                'example' => 'https://example.com/portrait.jpg',
            ],
            'is_active' => [
                'description' => 'Se o personagem está ativo',
                'example' => true,
            ],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        $rules = [
            'game_id' => ($isUpdate ? 'sometimes|' : 'required|') . 'integer|exists:games,id',
            'race_id' => ($isUpdate ? 'sometimes|' : 'required|') . 'integer|exists:races,id',
            'class_id' => ($isUpdate ? 'sometimes|' : 'required|') . 'integer|exists:classes,id',
            'name' => ($isUpdate ? 'sometimes|' : 'required|') . 'string|max:255',
            'level' => 'integer|min:1',
            'strength' => 'integer|min:1|max:30',
            'dexterity' => 'integer|min:1|max:30',
            'constitution' => 'integer|min:1|max:30',
            'intelligence' => 'integer|min:1|max:30',
            'wisdom' => 'integer|min:1|max:30',
            'charisma' => 'integer|min:1|max:30',
            'current_hit_points' => 'integer|min:0',
            'max_hit_points' => 'integer|min:1',
            'armor_class' => 'integer|min:0',
            'initiative' => 'integer',
            'speed' => 'integer|min:0',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'portrait_url' => 'nullable|string|url',
            'is_active' => 'boolean',
        ];

        // Add required validation for create operations
        if (!$isUpdate) {
            $rules['strength'] = 'required|' . $rules['strength'];
            $rules['dexterity'] = 'required|' . $rules['dexterity'];
            $rules['constitution'] = 'required|' . $rules['constitution'];
            $rules['intelligence'] = 'required|' . $rules['intelligence'];
            $rules['wisdom'] = 'required|' . $rules['wisdom'];
            $rules['charisma'] = 'required|' . $rules['charisma'];
            $rules['current_hit_points'] = 'required|' . $rules['current_hit_points'];
            $rules['max_hit_points'] = 'required|' . $rules['max_hit_points'];
            $rules['armor_class'] = 'required|' . $rules['armor_class'];
            $rules['initiative'] = 'required|' . $rules['initiative'];
            $rules['speed'] = 'required|' . $rules['speed'];
        }

        return $rules;
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Validate that race belongs to the specified game
            if ($this->has('game_id') && $this->has('race_id')) {
                $raceExists = \App\Models\Race::where('id', $this->race_id)
                    ->where('game_id', $this->game_id)
                    ->exists();

                if (!$raceExists) {
                    $validator->errors()->add('race_id', 'A raça selecionada não pertence ao jogo especificado.');
                }
            }

            // Validate that class belongs to the specified game
            if ($this->has('game_id') && $this->has('class_id')) {
                $classExists = \App\Models\GameClass::where('id', $this->class_id)
                    ->where('game_id', $this->game_id)
                    ->exists();

                if (!$classExists) {
                    $validator->errors()->add('class_id', 'A classe selecionada não pertence ao jogo especificado.');
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
            'user_id.required' => 'O usuário é obrigatório.',
            'user_id.exists' => 'O usuário selecionado não existe.',
            'game_id.required' => 'O jogo é obrigatório.',
            'game_id.exists' => 'O jogo selecionado não existe.',
            'race_id.required' => 'A raça é obrigatória.',
            'race_id.exists' => 'A raça selecionada não existe.',
            'class_id.required' => 'A classe é obrigatória.',
            'class_id.exists' => 'A classe selecionada não existe.',
            'name.required' => 'O nome do personagem é obrigatório.',
            'level.min' => 'O nível deve ser pelo menos 1.',
            'level.max' => 'O nível não pode exceder 20.',
            'strength.min' => 'A força deve ser pelo menos 1.',
            'strength.max' => 'A força não pode exceder 30.',
            'dexterity.min' => 'A destreza deve ser pelo menos 1.',
            'dexterity.max' => 'A destreza não pode exceder 30.',
            'constitution.min' => 'A constituição deve ser pelo menos 1.',
            'constitution.max' => 'A constituição não pode exceder 30.',
            'intelligence.min' => 'A inteligência deve ser pelo menos 1.',
            'intelligence.max' => 'A inteligência não pode exceder 30.',
            'wisdom.min' => 'A sabedoria deve ser pelo menos 1.',
            'wisdom.max' => 'A sabedoria não pode exceder 30.',
            'charisma.min' => 'O carisma deve ser pelo menos 1.',
            'charisma.max' => 'O carisma não pode exceder 30.',
            'current_hit_points.min' => 'Os pontos de vida atuais não podem ser negativos.',
            'max_hit_points.min' => 'Os pontos de vida máximos devem ser pelo menos 1.',
            'armor_class.min' => 'A classe de armadura deve ser pelo menos 1.',
            'armor_class.max' => 'A classe de armadura não pode exceder 30.',
            'speed.min' => 'A velocidade não pode ser negativa.',
            'portrait_url.url' => 'A URL do retrato deve ser uma URL válida.',
        ];
    }
}
