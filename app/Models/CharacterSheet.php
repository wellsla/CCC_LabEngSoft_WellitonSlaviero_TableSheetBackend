<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacterSheet extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'game_id',
        'race_id',
        'class_id',
        'name',
        'level',
        'strength',
        'dexterity',
        'constitution',
        'intelligence',
        'wisdom',
        'charisma',
        'current_hit_points',
        'max_hit_points',
        'armor_class',
        'initiative',
        'speed',
        'description',
        'notes',
        'portrait_url',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the user that owns the character sheet.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the game that the character sheet belongs to.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Get the race of the character sheet.
     */
    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    /**
     * Get the class of the character sheet.
     */
    public function class()
    {
        return $this->belongsTo(GameClass::class, 'class_id');
    }
}
