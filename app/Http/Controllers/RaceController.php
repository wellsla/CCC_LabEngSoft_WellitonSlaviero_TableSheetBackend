<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;

/**
 * @group Races
 *
 * APIs for managing tabletop RPG races
 */
class RaceController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $query = Race::with('game');

        // Filter by name
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }

        // Filter by game
        if ($request->has('game_id')) {
            $query->where('game_id', $request->get('game_id'));
        }

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        // Validate sort field
        $allowedSortFields = ['name', 'created_at', 'updated_at'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortDirection === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $races = $query->paginate($perPage);

        return $this->paginatedResponse($races, 'Races retrieved successfully');
    }

    public function show($id)
    {
        $race = Race::find($id);

        if (!$race) {
            return $this->notFoundResponse('Raça não encontrada. O ID informado não existe ou foi removido.');
        }

        return $this->successResponse(
            $race->load('game'),
            'Raça recuperada com sucesso'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $race = Race::create([
            'game_id' => $request->game_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $this->createdResponse($race->load('game'), 'Race created successfully');
    }

    public function update(Request $request, $id)
    {
        $race = Race::find($id);

        if (!$race) {
            return $this->notFoundResponse('Raça não encontrada. O ID informado não existe ou foi removido.');
        }

        $request->validate([
            'game_id' => 'exists:games,id',
            'name' => 'string|max:255',
            'description' => 'nullable|string',
        ]);

        $race->update($request->only([
            'game_id', 'name', 'description'
        ]));

        return $this->updatedResponse($race->fresh()->load('game'), 'Raça atualizada com sucesso');
    }

    public function destroy($id)
    {
        $race = Race::find($id);

        if (!$race) {
            return $this->notFoundResponse('Raça não encontrada. O ID informado não existe ou foi removido.');
        }

        $race->delete();

        return $this->deletedResponse('Raça excluída com sucesso');
    }
}
