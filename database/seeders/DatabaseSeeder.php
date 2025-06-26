<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Game;
use App\Models\Race;
use App\Models\GameClass;
use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        $admin = User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@tablesheet.com',
            'password' => Hash::make(env('ADMIN_DEFAULT_PASSWORD', 'TableSheet@2024!')),
            'birth_date' => '1990-01-01',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Create sample games
        $dnd5e = Game::create([
            'name' => 'Dungeons & Dragons 5th Edition',
            'description' => 'The world\'s greatest roleplaying game. Create heroic characters and embark on epic adventures in a fantasy world of magic and monsters.',
            'version' => '5.0',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        $pathfinder = Game::create([
            'name' => 'Pathfinder 2nd Edition',
            'description' => 'A fantasy tabletop roleplaying game where players take on the role of brave adventurers fighting to survive in a world beset by magic and evil.',
            'version' => '2.0',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        // Create sample races for D&D 5e
        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Human',
            'description' => 'Versatile and ambitious, humans are the most common race in most fantasy worlds.',
        ]);

        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Elf',
            'description' => 'Magical people of otherworldly grace, living in places of ethereal beauty.',
        ]);

        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Dwarf',
            'description' => 'Bold and hardy, dwarves are known as skilled warriors, miners, and workers of stone and metal.',
        ]);

        Race::create([
            'game_id' => $dnd5e->id,
            'name' => 'Halfling',
            'description' => 'Small folk who love peace, good food, hearth and home.',
        ]);

        // Create sample races for Pathfinder
        Race::create([
            'game_id' => $pathfinder->id,
            'name' => 'Human',
            'description' => 'Ambitious, sometimes heroic, and always confident, humans have an ability to work together toward common goals.',
        ]);

        Race::create([
            'game_id' => $pathfinder->id,
            'name' => 'Elf',
            'description' => 'As an ancient people, elves have seen great change and have the perspective that can come only from watching the arc of history.',
        ]);

        // Create sample classes for D&D 5e
        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Fighter',
            'description' => 'A master of martial combat, skilled with a variety of weapons and armor.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Wizard',
            'description' => 'A scholarly magic-user capable of manipulating the structures of reality.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Rogue',
            'description' => 'A scoundrel who uses stealth and trickery to achieve their goals.',
        ]);

        GameClass::create([
            'game_id' => $dnd5e->id,
            'name' => 'Cleric',
            'description' => 'A priestly champion who wields divine magic in service of a higher power.',
        ]);

        // Create sample classes for Pathfinder
        GameClass::create([
            'game_id' => $pathfinder->id,
            'name' => 'Fighter',
            'description' => 'Fighting for honor, greed, loyalty, or simply the thrill of battle, you are an undisputed master of weaponry and combat techniques.',
        ]);

        GameClass::create([
            'game_id' => $pathfinder->id,
            'name' => 'Wizard',
            'description' => 'You seek to uncover the secrets of magic through careful study and rigorous academic pursuit.',
        ]);

        // Create sample books
        Book::create([
            'game_id' => $dnd5e->id,
            'name' => 'Player\'s Handbook',
            'description' => 'The essential reference for every Dungeons & Dragons roleplayer.',
            'document_url' => 'https://example.com/dnd5e-phb.pdf',
            'created_by' => $admin->id,
        ]);

        Book::create([
            'game_id' => $pathfinder->id,
            'name' => 'Core Rulebook',
            'description' => 'The essential rules for the Pathfinder Roleplaying Game.',
            'document_url' => 'https://example.com/pathfinder-core.pdf',
            'created_by' => $admin->id,
        ]);
    }
}
