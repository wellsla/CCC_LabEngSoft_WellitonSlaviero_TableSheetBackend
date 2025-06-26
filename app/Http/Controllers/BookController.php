<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

/**
 * @group Books
 *
 * APIs for managing tabletop RPG books/documents
 */
class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $query = Book::with('game');

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

        $books = $query->paginate($perPage);

        return $this->paginatedResponse($books, 'Livros recuperados com sucesso');
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->notFoundResponse('Livro não encontrado. O ID informado não existe ou foi removido.');
        }

        return $this->successResponse(
            $book->load('game'),
            'Livro recuperado com sucesso'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document_url' => 'required|string|url',
        ]);

        $book = Book::create([
            'game_id' => $request->game_id,
            'name' => $request->name,
            'description' => $request->description,
            'document_url' => $request->document_url,
            'created_by' => auth()->id(),
        ]);

        return $this->createdResponse($book->load('game'), 'Livro criado com sucesso');
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->notFoundResponse('Livro não encontrado. O ID informado não existe ou foi removido.');
        }

        $request->validate([
            'game_id' => 'exists:games,id',
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'document_url' => 'string|url',
        ]);

        $book->update($request->only([
            'game_id', 'name', 'description', 'document_url'
        ]));

        return $this->updatedResponse($book->fresh()->load('game'), 'Livro atualizado com sucesso');
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->notFoundResponse('Livro não encontrado. O ID informado não existe ou foi removido.');
        }

        $book->delete();

        return $this->deletedResponse('Livro excluído com sucesso');
    }
}
