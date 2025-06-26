<?php

namespace App\Http\Controllers;

use App\Models\CharacterSheet;
use App\Http\Requests\CharacterSheetRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Character Sheets
 *
 * APIs for managing character sheets for tabletop RPG games
 */
class CharacterSheetController extends Controller
{
    /**
     * List character sheets
     *
     * Retrieve a paginated list of character sheets. Regular users see only their own sheets, while admins see all sheets.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @queryParam per_page integer Number of items per page (default: 15). Example: 10
     * @queryParam name string Filter by character name. Example: Aragorn
     * @queryParam status string Filter by status (active/inactive). Example: active
     * @queryParam game_id integer Filter by game ID. Example: 1
     * @queryParam sort string Sort field (name, level, created_at, updated_at). Example: name
     * @queryParam direction string Sort direction (asc/desc). Example: asc
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Aragorn",
     *       "level": 5,
     *       "strength": 16,
     *       "dexterity": 14,
     *       "constitution": 15,
     *       "intelligence": 12,
     *       "wisdom": 13,
     *       "charisma": 14,
     *       "current_hit_points": 45,
     *       "max_hit_points": 50,
     *       "armor_class": 18,
     *       "initiative": 2,
     *       "speed": 30,
     *       "description": "A ranger from the North",
     *       "notes": "Has a magical sword",
     *       "portrait_url": "https://example.com/portrait.jpg",
     *       "is_active": true,
     *       "game": {
     *         "id": 1,
     *         "name": "Dungeons & Dragons 5e"
     *       },
     *       "race": {
     *         "id": 1,
     *         "name": "Human"
     *       },
     *       "class": {
     *         "id": 1,
     *         "name": "Ranger"
     *       }
     *     }
     *   ],
     *   "meta": {
     *     "current_page": 1,
     *     "per_page": 15,
     *     "total": 1
     *   },
     *   "message": "Character sheets retrieved successfully"
     * }
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $perPage = $request->get('per_page', 15);

        if ($user->is_admin) {
            $query = CharacterSheet::with(['user', 'game', 'race', 'class']);
        } else {
            $query = $user->sheets()->with(['game', 'race', 'class']);
        }

        // Filter by name
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }

        // Filter by status (is_active)
        if ($request->has('status')) {
            $status = $request->get('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Filter by game_id
        if ($request->has('game_id')) {
            $query->where('game_id', $request->get('game_id'));
        }

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        // Validate sort field
        $allowedSortFields = ['name', 'level', 'created_at', 'updated_at'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortDirection === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $sheets = $query->paginate($perPage);

        return $this->paginatedResponse($sheets, 'Fichas de personagem recuperadas com sucesso');
    }

    /**
     * Create character sheet
     *
     * Create a new character sheet for the authenticated user.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @bodyParam game_id integer required The game ID. Example: 1
     * @bodyParam race_id integer required The race ID. Example: 1
     * @bodyParam class_id integer required The class ID. Example: 1
     * @bodyParam name string required The character name. Example: Aragorn
     * @bodyParam level integer The character level (default: 1). Example: 5
     * @bodyParam strength integer required Strength attribute. Example: 16
     * @bodyParam dexterity integer required Dexterity attribute. Example: 14
     * @bodyParam constitution integer required Constitution attribute. Example: 15
     * @bodyParam intelligence integer required Intelligence attribute. Example: 12
     * @bodyParam wisdom integer required Wisdom attribute. Example: 13
     * @bodyParam charisma integer required Charisma attribute. Example: 14
     * @bodyParam current_hit_points integer required Current hit points. Example: 45
     * @bodyParam max_hit_points integer required Maximum hit points. Example: 50
     * @bodyParam armor_class integer required Armor class. Example: 18
     * @bodyParam initiative integer required Initiative modifier. Example: 2
     * @bodyParam speed integer required Movement speed. Example: 30
     * @bodyParam description string Character description. Example: A ranger from the North
     * @bodyParam notes string Character notes. Example: Has a magical sword
     * @bodyParam portrait_url string Character portrait URL. Example: https://example.com/portrait.jpg
     *
     * @response 201 {
     *   "data": {
     *     "id": 1,
     *     "name": "Aragorn",
     *     "level": 5,
     *     "strength": 16,
     *     "dexterity": 14,
     *     "constitution": 15,
     *     "intelligence": 12,
     *     "wisdom": 13,
     *     "charisma": 14,
     *     "current_hit_points": 45,
     *     "max_hit_points": 50,
     *     "armor_class": 18,
     *     "initiative": 2,
     *     "speed": 30,
     *     "description": "A ranger from the North",
     *     "notes": "Has a magical sword",
     *     "portrait_url": "https://example.com/portrait.jpg",
     *     "is_active": true,
     *     "game": {
     *       "id": 1,
     *       "name": "Dungeons & Dragons 5e"
     *     },
     *     "race": {
     *       "id": 1,
     *       "name": "Human"
     *     },
     *     "class": {
     *       "id": 1,
     *       "name": "Ranger"
     *     }
     *   },
     *   "message": "Character sheet created successfully"
     * }
     */
    public function store(CharacterSheetRequest $request)
    {

        $sheet = CharacterSheet::create([
            'user_id' => auth()->id(),
            'game_id' => $request->game_id,
            'race_id' => $request->race_id,
            'class_id' => $request->class_id,
            'name' => $request->name,
            'level' => $request->level ?? 1,
            'strength' => $request->strength,
            'dexterity' => $request->dexterity,
            'constitution' => $request->constitution,
            'intelligence' => $request->intelligence,
            'wisdom' => $request->wisdom,
            'charisma' => $request->charisma,
            'current_hit_points' => $request->current_hit_points,
            'max_hit_points' => $request->max_hit_points,
            'armor_class' => $request->armor_class,
            'initiative' => $request->initiative,
            'speed' => $request->speed,
            'description' => $request->description,
            'notes' => $request->notes,
            'portrait_url' => $request->portrait_url,
        ]);

        return $this->createdResponse(
            $sheet->load(['game', 'race', 'class']),
            'Ficha de personagem criada com sucesso'
        );
    }

    /**
     * Get character sheet
     *
     * Retrieve a specific character sheet by ID. Users can only view their own sheets unless they are admin.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @urlParam sheet integer required The character sheet ID. Example: 1
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "name": "Aragorn",
     *     "level": 5,
     *     "strength": 16,
     *     "dexterity": 14,
     *     "constitution": 15,
     *     "intelligence": 12,
     *     "wisdom": 13,
     *     "charisma": 14,
     *     "current_hit_points": 45,
     *     "max_hit_points": 50,
     *     "armor_class": 18,
     *     "initiative": 2,
     *     "speed": 30,
     *     "description": "A ranger from the North",
     *     "notes": "Has a magical sword",
     *     "portrait_url": "https://example.com/portrait.jpg",
     *     "is_active": true,
     *     "user": {
     *       "id": 1,
     *       "username": "john_doe",
     *       "name": "John Doe"
     *     },
     *     "game": {
     *       "id": 1,
     *       "name": "Dungeons & Dragons 5e"
     *     },
     *     "race": {
     *       "id": 1,
     *       "name": "Human"
     *     },
     *     "class": {
     *       "id": 1,
     *       "name": "Ranger"
     *     }
     *   },
     *   "message": "Character sheet retrieved successfully"
     * }
     * @response 403 {
     *   "message": "This action is unauthorized."
     * }
     * @response 404 {
     *   "message": "Character sheet not found."
     * }
     */
    public function show($id)
    {
        $sheet = CharacterSheet::find($id);

        if (!$sheet) {
            return $this->notFoundResponse('Ficha de personagem não encontrada. O ID informado não existe ou foi removido.');
        }

        $this->authorize('view', $sheet);

        return $this->successResponse(
            $sheet->load(['user', 'game', 'race', 'class']),
            'Ficha de personagem recuperada com sucesso'
        );
    }

    /**
     * Update character sheet
     *
     * Update an existing character sheet. Users can only update their own sheets unless they are admin.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @urlParam sheet integer required The character sheet ID. Example: 1
     * @bodyParam game_id integer The game ID. Example: 1
     * @bodyParam race_id integer The race ID. Example: 1
     * @bodyParam class_id integer The class ID. Example: 1
     * @bodyParam name string The character name. Example: Aragorn
     * @bodyParam level integer The character level. Example: 6
     * @bodyParam strength integer Strength attribute. Example: 17
     * @bodyParam dexterity integer Dexterity attribute. Example: 14
     * @bodyParam constitution integer Constitution attribute. Example: 15
     * @bodyParam intelligence integer Intelligence attribute. Example: 12
     * @bodyParam wisdom integer Wisdom attribute. Example: 13
     * @bodyParam charisma integer Charisma attribute. Example: 14
     * @bodyParam current_hit_points integer Current hit points. Example: 50
     * @bodyParam max_hit_points integer Maximum hit points. Example: 55
     * @bodyParam armor_class integer Armor class. Example: 19
     * @bodyParam initiative integer Initiative modifier. Example: 2
     * @bodyParam speed integer Movement speed. Example: 30
     * @bodyParam description string Character description. Example: A ranger from the North
     * @bodyParam notes string Character notes. Example: Has a magical sword
     * @bodyParam portrait_url string Character portrait URL. Example: https://example.com/portrait.jpg
     * @bodyParam is_active boolean Character active status. Example: true
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "name": "Aragorn",
     *     "level": 6,
     *     "strength": 17,
     *     "current_hit_points": 50,
     *     "max_hit_points": 55,
     *     "armor_class": 19,
     *     "game": {
     *       "id": 1,
     *       "name": "Dungeons & Dragons 5e"
     *     },
     *     "race": {
     *       "id": 1,
     *       "name": "Human"
     *     },
     *     "class": {
     *       "id": 1,
     *       "name": "Ranger"
     *     }
     *   },
     *   "message": "Character sheet updated successfully"
     * }
     * @response 403 {
     *   "message": "This action is unauthorized."
     * }
     */
    public function update(CharacterSheetRequest $request, $id)
    {
        $sheet = CharacterSheet::find($id);

        if (!$sheet) {
            return $this->notFoundResponse('Ficha de personagem não encontrada. O ID informado não existe ou foi removido.');
        }

        $this->authorize('update', $sheet);

        $sheet->update($request->only([
            'game_id', 'race_id', 'class_id', 'name', 'level',
            'strength', 'dexterity', 'constitution', 'intelligence', 'wisdom', 'charisma',
            'current_hit_points', 'max_hit_points', 'armor_class', 'initiative', 'speed',
            'description', 'notes', 'portrait_url', 'is_active'
        ]));

        return $this->updatedResponse(
            $sheet->fresh()->load(['game', 'race', 'class']),
            'Ficha de personagem atualizada com sucesso'
        );
    }

    /**
     * Delete character sheet
     *
     * Delete a character sheet. Users can only delete their own sheets unless they are admin.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @urlParam sheet integer required The character sheet ID. Example: 1
     *
     * @response 200 {
     *   "message": "Character sheet deleted successfully"
     * }
     * @response 403 {
     *   "message": "This action is unauthorized."
     * }
     * @response 404 {
     *   "message": "Character sheet not found."
     * }
     */
    public function destroy($id): JsonResponse
    {
        $sheet = CharacterSheet::find($id);

        if (!$sheet) {
            return $this->notFoundResponse('Ficha de personagem não encontrada. O ID informado não existe ou foi removido.');
        }

        $this->authorize('delete', $sheet);

        $sheet->delete();

        return $this->deletedResponse('Ficha de personagem excluída com sucesso');
    }
}
