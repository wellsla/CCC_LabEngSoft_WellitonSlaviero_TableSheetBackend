<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'version',
        'cover_image_url',
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
     * Get the books for the game.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Get the character sheets for the game.
     */
    public function sheets()
    {
        return $this->hasMany(CharacterSheet::class);
    }

    /**
     * Get the races for the game.
     */
    public function races()
    {
        return $this->hasMany(Race::class);
    }

    /**
     * Get the classes for the game.
     */
    public function classes()
    {
        return $this->hasMany(GameClass::class);
    }
}
