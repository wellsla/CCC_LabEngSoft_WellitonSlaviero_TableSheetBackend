<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Game;
use App\Models\CharacterSheet;
use App\Models\Book;
use App\Traits\TransformsFileUrls;

class FileUploadController extends Controller
{
    use TransformsFileUrls;

    /**
     * Validate file content by checking file signature (magic numbers)
     */
    private function validateFileContent(UploadedFile $file, string $fileType): bool
    {
        $signatures = config('fileupload.file_signatures.' . strtolower($fileType), []);

        if (empty($signatures)) {
            return false;
        }

        $fileHandle = fopen($file->getPathname(), 'rb');
        if (!$fileHandle) {
            return false;
        }

        $fileHeader = fread($fileHandle, 8);
        fclose($fileHandle);

        $fileSignature = strtoupper(bin2hex($fileHeader));

        foreach ($signatures as $signature) {
            if (strpos($fileSignature, $signature) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generic file upload method
     */
    private function uploadFile(Request $request, string $fileKey, string $configKey, string $successMessage): \Illuminate\Http\JsonResponse
    {
        $config = config('fileupload.' . $configKey);

        if (!$config) {
            return response()->json(['message' => 'Configuração de tipo de arquivo inválida'], 500);
        }

        // Build validation rules from config
        $mimes = implode(',', $config['allowed_mimes']);
        $maxSize = $config['max_size'];

        $request->validate([
            $fileKey => "required|file|mimes:{$mimes}|max:{$maxSize}",
        ]);

        $file = $request->file($fileKey);

        // Validate file extension
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $config['allowed_extensions'])) {
            return response()->json(['message' => 'Extensão de arquivo inválida'], 422);
        }

        // Validate actual file content
        if (!$this->validateFileContent($file, $extension)) {
            return response()->json(['message' => 'O conteúdo do arquivo não corresponde ao tipo esperado'], 422);
        }

        // Generate secure filename
        $filename = time() . '_' . uniqid() . '.' . $extension;
        $path = $file->storeAs($config['storage_path'], $filename, $config['disk']);

        $url = Storage::disk($config['disk'])->url($path);

        return response()->json([
            'message' => $successMessage,
            'data' => [
                'url' => $url,
                'path' => $path
            ]
        ]);
    }

    /**
     * Upload avatar for authenticated user
     */
    public function uploadAvatar(Request $request)
    {
        $config = config('fileupload.avatars');

        if (!$config) {
            return response()->json(['message' => 'Configuração de avatar inválida'], 500);
        }

        // Build validation rules from config
        $mimes = implode(',', $config['allowed_mimes']);
        $maxSize = $config['max_size'];

        $request->validate([
            'avatar' => "required|file|mimes:{$mimes}|max:{$maxSize}",
        ]);

        $file = $request->file('avatar');

        // Validate file extension
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $config['allowed_extensions'])) {
            return response()->json(['message' => 'Extensão de arquivo inválida'], 422);
        }

        // Validate actual file content
        if (!$this->validateFileContent($file, $extension)) {
            return response()->json(['message' => 'O conteúdo do arquivo não corresponde ao tipo esperado'], 422);
        }

        // Delete old avatar if exists
        $user = auth()->user();
        if ($user->avatar_url) {
            $oldPath = str_replace('/storage/', '', parse_url($user->avatar_url, PHP_URL_PATH));
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Generate secure filename
        $filename = time() . '_' . uniqid() . '.' . $extension;
        $path = $file->storeAs($config['storage_path'], $filename, $config['disk']);
        $url = Storage::disk($config['disk'])->url($path);

        // Update user avatar_url
        $user->update(['avatar_url' => $this->transformUrlForDatabase($url)]);

        return response()->json([
            'message' => 'Avatar enviado com sucesso',
            'data' => [
                'url' => $url,
                'path' => $path
            ]
        ]);
    }

    /**
     * Upload portrait for character sheet (only sheet owner)
     */
    public function uploadPortrait(Request $request)
    {
        $request->validate([
            'character_sheet_id' => 'required|exists:character_sheets,id',
        ]);

        $characterSheet = CharacterSheet::findOrFail($request->character_sheet_id);

        // Check if user owns the character sheet
        if ($characterSheet->user_id !== auth()->id()) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $config = config('fileupload.portraits');

        if (!$config) {
            return response()->json(['message' => 'Configuração de retrato inválida'], 500);
        }

        // Build validation rules from config
        $mimes = implode(',', $config['allowed_mimes']);
        $maxSize = $config['max_size'];

        $request->validate([
            'portrait' => "required|file|mimes:{$mimes}|max:{$maxSize}",
        ]);

        $file = $request->file('portrait');

        // Validate file extension
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $config['allowed_extensions'])) {
            return response()->json(['message' => 'Extensão de arquivo inválida'], 422);
        }

        // Validate actual file content
        if (!$this->validateFileContent($file, $extension)) {
            return response()->json(['message' => 'O conteúdo do arquivo não corresponde ao tipo esperado'], 422);
        }

        // Delete old portrait if exists
        if ($characterSheet->portrait_url) {
            $oldPath = str_replace('/storage/', '', parse_url($characterSheet->portrait_url, PHP_URL_PATH));
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Generate secure filename
        $filename = time() . '_' . uniqid() . '.' . $extension;
        $path = $file->storeAs($config['storage_path'], $filename, $config['disk']);
        $url = Storage::disk($config['disk'])->url($path);

        // Update character sheet portrait_url
        $characterSheet->update(['portrait_url' => $this->transformUrlForDatabase($url)]);

        return response()->json([
            'message' => 'Retrato enviado com sucesso',
            'data' => [
                'url' => $url,
                'path' => $path
            ]
        ]);
    }

    /**
     * Upload cover image for game (admin only)
     */
    public function uploadCoverImage(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
        ]);

        $game = Game::findOrFail($request->game_id);

        $config = config('fileupload.cover_images');

        if (!$config) {
            return response()->json(['message' => 'Configuração de imagem de capa inválida'], 500);
        }

        // Build validation rules from config
        $mimes = implode(',', $config['allowed_mimes']);
        $maxSize = $config['max_size'];

        $request->validate([
            'cover_image' => "required|file|mimes:{$mimes}|max:{$maxSize}",
        ]);

        $file = $request->file('cover_image');

        // Validate file extension
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $config['allowed_extensions'])) {
            return response()->json(['message' => 'Extensão de arquivo inválida'], 422);
        }

        // Validate actual file content
        if (!$this->validateFileContent($file, $extension)) {
            return response()->json(['message' => 'O conteúdo do arquivo não corresponde ao tipo esperado'], 422);
        }

        // Delete old cover image if exists
        if ($game->cover_image_url) {
            $oldPath = str_replace('/storage/', '', parse_url($game->cover_image_url, PHP_URL_PATH));
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Generate secure filename
        $filename = time() . '_' . uniqid() . '.' . $extension;
        $path = $file->storeAs($config['storage_path'], $filename, $config['disk']);
        $url = Storage::disk($config['disk'])->url($path);

        // Update game cover_image_url
        $game->update(['cover_image_url' => $this->transformUrlForDatabase($url)]);

        return response()->json([
            'message' => 'Imagem de capa enviada com sucesso',
            'data' => [
                'url' => $url,
                'path' => $path
            ]
        ]);
    }

    /**
     * Upload document for book (admin only)
     */
    public function uploadDocument(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        $config = config('fileupload.documents');

        if (!$config) {
            return response()->json(['message' => 'Configuração de documento inválida'], 500);
        }

        // Build validation rules from config
        $mimes = implode(',', $config['allowed_mimes']);
        $maxSize = $config['max_size'];

        $request->validate([
            'document' => "required|file|mimes:{$mimes}|max:{$maxSize}",
        ]);

        $file = $request->file('document');

        // Validate file extension
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $config['allowed_extensions'])) {
            return response()->json(['message' => 'Extensão de arquivo inválida'], 422);
        }

        // Validate actual file content
        if (!$this->validateFileContent($file, $extension)) {
            return response()->json(['message' => 'O conteúdo do arquivo não corresponde ao tipo esperado'], 422);
        }

        // Delete old document if exists
        if ($book->document_url) {
            $oldPath = str_replace('/storage/', '', parse_url($book->document_url, PHP_URL_PATH));
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Generate secure filename
        $filename = time() . '_' . uniqid() . '.' . $extension;
        $path = $file->storeAs($config['storage_path'], $filename, $config['disk']);
        $url = Storage::disk($config['disk'])->url($path);

        // Update book document_url
        $book->update(['document_url' => $this->transformUrlForDatabase($url)]);

        return response()->json([
            'message' => 'Documento enviado com sucesso',
            'data' => [
                'url' => $url,
                'path' => $path
            ]
        ]);
    }

    public function deleteFile(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        $path = $request->path;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);

            return response()->json([
                'message' => 'Arquivo excluído com sucesso'
            ]);
        }

        return response()->json([
            'message' => 'Arquivo não encontrado'
        ], 404);
    }
}
