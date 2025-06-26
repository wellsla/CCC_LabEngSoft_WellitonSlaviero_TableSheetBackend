<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\User;
use App\Models\CharacterSheet;
use App\Models\Game;

class DocumentController extends Controller
{
    /**
     * Serve a document file by filename
     */
    public function serveDocument($filename)
    {
        $path = 'documents/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Document not found');
        }

        $file = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        return response($file, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }

    /**
     * Serve a book's document
     */
    public function serveBookDocument($bookId)
    {
        $book = Book::findOrFail($bookId);

        if (!$book->document_url) {
            abort(404, 'Book document not found');
        }

        // Extract filename from document_url
        $filename = basename($book->document_url);

        return $this->serveDocument($filename);
    }

    /**
     * Serve an avatar file by filename
     */
    public function serveAvatar($filename)
    {
        $path = 'avatars/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Avatar not found');
        }

        $file = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        return response($file, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }

    /**
     * Serve a user's avatar
     */
    public function serveUserAvatar($userId)
    {
        $user = User::findOrFail($userId);

        if (!$user->avatar_url) {
            abort(404, 'User avatar not found');
        }

        // Extract filename from avatar_url
        $filename = basename($user->avatar_url);

        return $this->serveAvatar($filename);
    }

    /**
     * Serve a portrait file by filename
     */
    public function servePortrait($filename)
    {
        $path = 'portraits/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Portrait not found');
        }

        $file = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        return response($file, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }

    /**
     * Serve a character sheet's portrait
     */
    public function serveSheetPortrait($sheetId)
    {
        $sheet = CharacterSheet::findOrFail($sheetId);

        if (!$sheet->portrait_url) {
            abort(404, 'Sheet portrait not found');
        }

        // Extract filename from portrait_url
        $filename = basename($sheet->portrait_url);

        return $this->servePortrait($filename);
    }

    /**
     * Serve a cover image file by filename
     */
    public function serveCoverImage($filename)
    {
        $path = 'covers/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Cover image not found');
        }

        $file = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        return response($file, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }

    /**
     * Serve a game's cover image
     */
    public function serveGameCover($gameId)
    {
        $game = Game::findOrFail($gameId);

        if (!$game->cover_image_url) {
            abort(404, 'Game cover not found');
        }

        // Extract filename from cover_image_url
        $filename = basename($game->cover_image_url);

        return $this->serveCoverImage($filename);
    }
}
