<?php

namespace App\Http\Controllers;

use App\Models\CharacterSheet;
use Illuminate\Http\Request;

class CharacterSheetController extends Controller
{
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

        return $this->paginatedResponse($sheets, 'Character sheets retrieved successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|integer|exists:games,id',
            'race_id' => 'required|integer|exists:races,id',
            'class_id' => 'required|integer|exists:classes,id',
            'name' => 'required|string',
            'level' => 'integer|min:1',
            'strength' => 'required|integer|min:1|max:30',
            'dexterity' => 'required|integer|min:1|max:30',
            'constitution' => 'required|integer|min:1|max:30',
            'intelligence' => 'required|integer|min:1|max:30',
            'wisdom' => 'required|integer|min:1|max:30',
            'charisma' => 'required|integer|min:1|max:30',
            'current_hit_points' => 'required|integer|min:0',
            'max_hit_points' => 'required|integer|min:1',
            'armor_class' => 'required|integer|min:0',
            'initiative' => 'required|integer',
            'speed' => 'required|integer|min:0',
            'description' => 'string|nullable',
            'notes' => 'string|nullable',
            'portrait_url' => 'string|nullable',
        ]);

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
            'Character sheet created successfully'
        );
    }

    public function show(CharacterSheet $sheet)
    {
        $this->authorize('view', $sheet);

        return $this->successResponse(
            $sheet->load(['user', 'game', 'race', 'class']),
            'Character sheet retrieved successfully'
        );
    }

    public function update(Request $request, CharacterSheet $sheet)
    {
        $this->authorize('update', $sheet);

        $request->validate([
            'game_id' => 'integer|exists:games,id',
            'race_id' => 'integer|exists:races,id',
            'class_id' => 'integer|exists:classes,id',
            'name' => 'string',
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
            'description' => 'string|nullable',
            'notes' => 'string|nullable',
            'portrait_url' => 'string|nullable',
            'is_active' => 'boolean',
        ]);

        $sheet->update($request->only([
            'game_id', 'race_id', 'class_id', 'name', 'level',
            'strength', 'dexterity', 'constitution', 'intelligence', 'wisdom', 'charisma',
            'current_hit_points', 'max_hit_points', 'armor_class', 'initiative', 'speed',
            'description', 'notes', 'portrait_url', 'is_active'
        ]));

        return $this->updatedResponse(
            $sheet->fresh()->load(['game', 'race', 'class']),
            'Character sheet updated successfully'
        );
    }

    public function destroy(CharacterSheet $sheet)
    {
        $this->authorize('delete', $sheet);

        $sheet->delete();

        return $this->deletedResponse('Character sheet deleted successfully');
    }
}
