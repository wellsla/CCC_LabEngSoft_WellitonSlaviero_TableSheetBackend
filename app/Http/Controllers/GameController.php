<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\GameRequest;
use Illuminate\Http\Request;
use App\Traits\TransformsFileUrls;

/**
 * @group Games
 *
 * APIs for managing tabletop RPG games
 */
class GameController extends Controller
{
    use TransformsFileUrls;
    /**
     * List games
     *
     * Retrieve a paginated list of active games available in the system.
     *
     * @queryParam per_page integer Number of items per page (default: 15). Example: 10
     * @queryParam name string Filter by game name. Example: Dungeons
     * @queryParam status string Filter by status (active/inactive). Example: active
     * @queryParam sort string Sort field (name, created_at, updated_at, version). Example: name
     * @queryParam direction string Sort direction (asc/desc). Example: asc
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Dungeons & Dragons 5e",
     *       "description": "The latest edition of the world's greatest roleplaying game",
     *       "version": "5.0",
     *       "cover_image_url": "https://example.com/dnd5e-cover.jpg",
     *       "is_active": true,
     *       "created_at": "2024-01-01T12:00:00.000000Z",
     *       "updated_at": "2024-01-01T12:00:00.000000Z"
     *     }
     *   ],
     *   "meta": {
     *     "current_page": 1,
     *     "per_page": 15,
     *     "total": 1
     *   },
     *   "message": "Games retrieved successfully"
     * }
     */
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

    /**
     * Get game details
     *
     * Retrieve detailed information about a specific game, including its books, races, and classes.
     *
     * @urlParam game integer required The game ID. Example: 1
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "name": "Dungeons & Dragons 5e",
     *     "description": "The latest edition of the world's greatest roleplaying game",
     *     "version": "5.0",
     *     "cover_image_url": "https://example.com/dnd5e-cover.jpg",
     *     "is_active": true,
     *     "created_at": "2024-01-01T12:00:00.000000Z",
     *     "updated_at": "2024-01-01T12:00:00.000000Z",
     *     "books": [
     *       {
     *         "id": 1,
     *         "name": "Player's Handbook",
     *         "description": "Core rules for players",
     *         "document_url": "https://example.com/phb.pdf"
     *       }
     *     ],
     *     "races": [
     *       {
     *         "id": 1,
     *         "name": "Human",
     *         "description": "Versatile and ambitious"
     *       }
     *     ],
     *     "classes": [
     *       {
     *         "id": 1,
     *         "name": "Fighter",
     *         "description": "Master of martial combat"
     *       }
     *     ]
     *   },
     *   "message": "Game retrieved successfully"
     * }
     * @response 404 {
     *   "message": "Game not found"
     * }
     */
    public function show($id)
    {
        $game = Game::find($id);

        if (!$game) {
            return $this->notFoundResponse('Jogo não encontrado. O ID informado não existe ou foi removido.');
        }

        if (!$game->is_active) {
            return $this->notFoundResponse('Jogo não encontrado. O jogo está inativo ou foi removido.');
        }

        return $this->successResponse(
            $game->load(['books', 'races', 'classes']),
            'Jogo recuperado com sucesso'
        );
    }

    /**
     * Create game
     *
     * Create a new game. Requires admin privileges.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @bodyParam name string required The game name (must be unique). Example: Pathfinder 2e
     * @bodyParam description string required The game description. Example: A fantasy tabletop RPG
     * @bodyParam version string required The game version. Example: 2.0
     * @bodyParam cover_image_url string The game cover image URL. Example: https://example.com/cover.jpg
     *
     * @response 201 {
     *   "data": {
     *     "id": 2,
     *     "name": "Pathfinder 2e",
     *     "description": "A fantasy tabletop RPG",
     *     "version": "2.0",
     *     "cover_image_url": "https://example.com/cover.jpg",
     *     "is_active": true,
     *     "created_by": 1,
     *     "created_at": "2024-01-01T12:00:00.000000Z",
     *     "updated_at": "2024-01-01T12:00:00.000000Z"
     *   },
     *   "message": "Game created successfully"
     * }
     * @response 403 {
     *   "message": "This action is unauthorized."
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "name": ["The name has already been taken."]
     *   }
     * }
     */
    public function store(GameRequest $request)
    {

        $coverImageUrl = $request->cover_image_url;
        if ($coverImageUrl) {
            $coverImageUrl = $this->transformUrlForDatabase($coverImageUrl);
        }

        $game = Game::create([
            'name' => $request->name,
            'description' => $request->description,
            'version' => $request->version,
            'cover_image_url' => $coverImageUrl,
            'created_by' => auth()->id(),
        ]);

        return $this->createdResponse($game, 'Game created successfully');
    }

    /**
     * Update game
     *
     * Update an existing game. Requires admin privileges.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @urlParam game integer required The game ID. Example: 1
     * @bodyParam name string The game name (must be unique). Example: Dungeons & Dragons 5.5e
     * @bodyParam description string The game description. Example: Updated edition
     * @bodyParam version string The game version. Example: 5.5
     * @bodyParam cover_image_url string The game cover image URL. Example: https://example.com/new-cover.jpg
     * @bodyParam is_active boolean The game active status. Example: true
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "name": "Dungeons & Dragons 5.5e",
     *     "description": "Updated edition",
     *     "version": "5.5",
     *     "cover_image_url": "https://example.com/new-cover.jpg",
     *     "is_active": true,
     *     "created_by": 1,
     *     "created_at": "2024-01-01T12:00:00.000000Z",
     *     "updated_at": "2024-01-01T13:00:00.000000Z"
     *   },
     *   "message": "Game updated successfully"
     * }
     * @response 403 {
     *   "message": "This action is unauthorized."
     * }
     */
    public function update(GameRequest $request, $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return $this->notFoundResponse('Jogo não encontrado. O ID informado não existe ou foi removido.');
        }

        $data = $request->only([
            'name', 'description', 'version', 'cover_image_url', 'is_active'
        ]);

        // Transform cover_image_url if present
        $data = $this->transformUrlFieldInData($data, 'cover_image_url');

        $game->update($data);

        return $this->updatedResponse($game->fresh(), 'Jogo atualizado com sucesso');
    }

    /**
     * Delete game
     *
     * Delete a game from the system. Requires admin privileges.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @urlParam game integer required The game ID. Example: 1
     *
     * @response 200 {
     *   "message": "Game deleted successfully"
     * }
     * @response 403 {
     *   "message": "This action is unauthorized."
     * }
     * @response 404 {
     *   "message": "Game not found."
     * }
     */
    public function destroy($id)
    {
        $game = Game::find($id);

        if (!$game) {
            return $this->notFoundResponse('Jogo não encontrado. O ID informado não existe ou foi removido.');
        }

        $game->delete();

        return $this->deletedResponse('Jogo excluído com sucesso');
    }
}
