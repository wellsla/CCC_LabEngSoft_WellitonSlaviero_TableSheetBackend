<?php

namespace App\Policies;

use App\Models\CharacterSheet;
use App\Models\User;

class CharacterSheetPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CharacterSheet $characterSheet): bool
    {
        return $user->id === $characterSheet->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CharacterSheet $characterSheet): bool
    {
        return $user->id === $characterSheet->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CharacterSheet $characterSheet): bool
    {
        return $user->id === $characterSheet->user_id || $user->is_admin;
    }
}
