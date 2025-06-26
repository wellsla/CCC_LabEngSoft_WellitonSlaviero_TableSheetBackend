<?php

namespace App\Http\Controllers;

use App\Models\GameClass;
use App\Http\Requests\ClassRequest;
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

    public function show(GameClass $gameClass)
    {
        return $this->successResponse(
            $gameClass->load('game'),
            'Classe recuperada com sucesso'
        );
    }

    public function store(ClassRequest $request)
    {

        $class = GameClass::create([
            'game_id' => $request->game_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $this->createdResponse($class->load('game'), 'Class created successfully');
    }

    public function update(ClassRequest $request, GameClass $gameClass)
    {

        $gameClass->update($request->only([
            'game_id', 'name', 'description'
        ]));

        return $this->updatedResponse($gameClass->fresh()->load('game'), 'Classe atualizada com sucesso');
    }

    public function destroy(GameClass $gameClass)
    {
        $gameClass->delete();

        return $this->deletedResponse('Classe excluída com sucesso');
    }
}
