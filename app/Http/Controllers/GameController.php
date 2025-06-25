<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

/**
 * @group Games
 *
 * APIs for managing tabletop RPG games
 */
class GameController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $query = Game::where('is_active', true);

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

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        // Validate sort field
        $allowedSortFields = ['name', 'created_at', 'updated_at', 'version'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortDirection === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $games = $query->paginate($perPage);

        return $this->paginatedResponse($games, 'Games retrieved successfully');
    }

    public function show(Game $game)
    {
        if (!$game->is_active) {
            return $this->notFoundResponse('Game not found');
        }

        return $this->successResponse(
            $game->load(['books', 'races', 'classes']),
            'Game retrieved successfully'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:games',
            'description' => 'required|string',
            'version' => 'required|string',
            'cover_image_url' => 'string|nullable',
        ]);

        $game = Game::create([
            'name' => $request->name,
            'description' => $request->description,
            'version' => $request->version,
            'cover_image_url' => $request->cover_image_url,
            'created_by' => auth()->id(),
        ]);

        return $this->createdResponse($game, 'Game created successfully');
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'string|unique:games,name,' . $game->id,
            'description' => 'string',
            'version' => 'string',
            'cover_image_url' => 'string|nullable',
            'is_active' => 'boolean',
        ]);

        $game->update($request->only([
            'name', 'description', 'version', 'cover_image_url', 'is_active'
        ]));

        return $this->updatedResponse($game->fresh(), 'Game updated successfully');
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return $this->deletedResponse('Game deleted successfully');
    }
}
