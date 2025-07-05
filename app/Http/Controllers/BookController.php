<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use App\Traits\TransformsFileUrls;

/**
 * @group Books
 *
 * APIs for managing tabletop RPG books/documents
 */
class BookController extends Controller
{
    use TransformsFileUrls;
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

    public function store(BookRequest $request)
    {

        $documentUrl = $request->document_url;
        if ($documentUrl) {
            $documentUrl = $this->transformUrlForDatabase($documentUrl);
        }

        $book = Book::create([
            'game_id' => $request->game_id,
            'name' => $request->name,
            'description' => $request->description,
            'document_url' => $documentUrl,
            'created_by' => auth()->id(),
        ]);

        return $this->createdResponse($book->load('game'), 'Livro criado com sucesso');
    }

    public function update(BookRequest $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->notFoundResponse('Livro não encontrado. O ID informado não existe ou foi removido.');
        }

        $data = $request->only([
            'game_id', 'name', 'description', 'document_url'
        ]);

        // Transform document_url if present
        $data = $this->transformUrlFieldInData($data, 'document_url');

        $book->update($data);

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
