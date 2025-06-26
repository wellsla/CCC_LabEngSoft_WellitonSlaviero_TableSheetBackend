<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Game;
use App\Models\Race;
use App\Models\GameClass;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar usuário administrador padrão
        $admin = User::create([
            'username' => 'admin',
            'name' => 'Administrador',
            'email' => 'admin@tablesheet.com',
            'password' => Hash::make(env('ADMIN_DEFAULT_PASSWORD', 'TableSheet@2024!')),
            'birth_date' => '1990-01-01',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Criar jogo Dungeons & Dragons
        $dnd5e = Game::create([
            'name' => 'Dungeons & Dragons',
            'description' => 'O maior jogo de RPG do mundo. Crie personagens heroicos e embarque em aventuras épicas em um mundo de fantasia repleto de magia e monstros.',
            'version' => '5.0',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        // Criar raças para D&D
        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Humano',
            'description' => 'Versáteis e ambiciosos, os humanos são a raça mais comum na maioria dos mundos de fantasia.',
        ]);

        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Elfo',
            'description' => 'Povo mágico de graça sobrenatural, vivendo em lugares de beleza etérea.',
        ]);

        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Anão',
            'description' => 'Corajosos e resistentes, os anões são conhecidos como guerreiros habilidosos, mineradores e trabalhadores de pedra e metal.',
        ]);

        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Halfling',
            'description' => 'Pequeno povo que ama a paz, boa comida, lar e conforto.',
        ]);

        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Meio-Elfo',
            'description' => 'Caminhando entre dois mundos, mas não pertencendo verdadeiramente a nenhum deles.',
        ]);

        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Meio-Orc',
            'description' => 'Alguns meio-orcs vivem entre humanos, lutando contra seus impulsos violentos.',
        ]);

        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Tiefling',
            'description' => 'Descendentes de humanos com herança infernal, carregando o legado de seus ancestrais.',
        ]);

        // Criar classes para D&D
        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Guerreiro',
            'description' => 'Um mestre do combate marcial, habilidoso com uma variedade de armas e armaduras.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Mago',
            'description' => 'Um usuário de magia erudito capaz de manipular as estruturas da realidade.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Ladino',
            'description' => 'Um patife que usa furtividade e truques para alcançar seus objetivos.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Clérico',
            'description' => 'Um campeão sacerdotal que empunha magia divina a serviço de um poder superior.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Ranger',
            'description' => 'Um guerreiro das terras selvagens, especialista em rastreamento e sobrevivência.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Paladino',
            'description' => 'Um guerreiro sagrado vinculado a um juramento sagrado, combatendo o mal.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Bárbaro',
            'description' => 'Um feroz guerreiro de origem primitiva que pode entrar em fúria de batalha.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Bardo',
            'description' => 'Um mestre das canções, discursos e da magia que eles contêm.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Druida',
            'description' => 'Um sacerdote da natureza, empunhando magia elemental e se transformando em animais.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Monge',
            'description' => 'Um mestre das artes marciais, aproveitando o poder do corpo em busca da perfeição física e espiritual.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Feiticeiro',
            'description' => 'Um conjurador que extrai sua magia inata de uma fonte dracônica ou outra origem exótica.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Bruxo',
            'description' => 'Um usuário de magia que fez um pacto com uma entidade extraplanar.',
        ]);

        // Criar livros para D&D
        Book::create([
            'game_id' => $dnd5e->id,
            'name' => 'Livro do Jogador',
            'description' => 'A referência essencial para todo jogador de Dungeons & Dragons.',
            'document_url' => 'http://host.docker.internal:8000/api/documents/DNDTESTE.pdf',
            'created_by' => $admin->id,
        ]);
    }
}
