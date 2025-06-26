<?php

namespace App\Http\Controllers;

use App\Models\GameClass;
use Illuminate\Http\Request;

/**
 * @group Classes
 *
 * APIs for managing tabletop RPG classes
 */
class ClassController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $query = GameClass::with('game');

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

        $classes = $query->paginate($perPage);

        return $this->paginatedResponse($classes, 'Classes retrieved successfully');
    }

    public function show($id)
    {
        $class = GameClass::find($id);

        if (!$class) {
            return $this->notFoundResponse('Classe não encontrada. O ID informado não existe ou foi removido.');
        }

        return $this->successResponse(
            $class->load('game'),
            'Classe recuperada com sucesso'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $class = GameClass::create([
            'game_id' => $request->game_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $this->createdResponse($class->load('game'), 'Class created successfully');
    }

    public function update(Request $request, $id)
    {
        $class = GameClass::find($id);

        if (!$class) {
            return $this->notFoundResponse('Classe não encontrada. O ID informado não existe ou foi removido.');
        }

        $request->validate([
            'game_id' => 'exists:games,id',
            'name' => 'string|max:255',
            'description' => 'nullable|string',
        ]);

        $class->update($request->only([
            'game_id', 'name', 'description'
        ]));

        return $this->updatedResponse($class->fresh()->load('game'), 'Classe atualizada com sucesso');
    }

    public function destroy($id)
    {
        $class = GameClass::find($id);

        if (!$class) {
            return $this->notFoundResponse('Classe não encontrada. O ID informado não existe ou foi removido.');
        }

        $class->delete();

        return $this->deletedResponse('Classe excluída com sucesso');
    }
}
