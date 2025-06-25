<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function uploadPortrait(Request $request)
    {
        $request->validate([
            'portrait' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        $file = $request->file('portrait');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('portraits', $filename, 'public');

        $url = Storage::url($path);

        return response()->json([
            'message' => 'Portrait uploaded successfully',
            'data' => [
                'url' => $url,
                'path' => $path
            ]
        ]);
    }

    public function uploadCoverImage(Request $request)
    {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        $file = $request->file('cover_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('covers', $filename, 'public');

        $url = Storage::url($path);

        return response()->json([
            'message' => 'Cover image uploaded successfully',
            'data' => [
                'url' => $url,
                'path' => $path
            ]
        ]);
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf|max:10240', // 10MB max for PDFs
        ]);

        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('documents', $filename, 'public');

        $url = Storage::url($path);

        return response()->json([
            'message' => 'Document uploaded successfully',
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
                'message' => 'File deleted successfully'
            ]);
        }

        return response()->json([
            'message' => 'File not found'
        ], 404);
    }
}
