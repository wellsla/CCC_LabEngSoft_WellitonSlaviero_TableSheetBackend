<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CharacterSheetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public
Route::get('/health', [HealthController::class, 'health']);
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('throttle:3,1');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('throttle:3,1');
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{game}', [GameController::class, 'show']);
Route::get('/races', [RaceController::class, 'index']);
Route::get('/races/{race}', [RaceController::class, 'show']);
Route::get('/classes', [ClassController::class, 'index']);
Route::get('/classes/{class}', [ClassController::class, 'show']);

// Authenticated
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/email/resend', [AuthController::class, 'resendVerification']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);

    // Sheets
    Route::get('/sheets', [CharacterSheetController::class, 'index']);
    Route::post('/sheets', [CharacterSheetController::class, 'store']);
    Route::get('/sheets/{sheet}', [CharacterSheetController::class, 'show']);
    Route::put('/sheets/{sheet}', [CharacterSheetController::class, 'update']);
    Route::delete('/sheets/{sheet}', [CharacterSheetController::class, 'destroy']);

    // Books - viewing only for authenticated users
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{book}', [BookController::class, 'show']);

    // File Uploads - General (for authenticated users)
    Route::post('/upload/avatar', [FileUploadController::class, 'uploadAvatar']);
    Route::post('/upload/portrait', [FileUploadController::class, 'uploadPortrait']);
    Route::delete('/upload/file', [FileUploadController::class, 'deleteFile']);

    // Admin
    Route::middleware('admin')->group(function () {
        // File Uploads - Admin only
        Route::post('/upload/cover-image', [FileUploadController::class, 'uploadCoverImage']);
        Route::post('/upload/document', [FileUploadController::class, 'uploadDocument']);

        Route::post('/games', [GameController::class, 'store']);
        Route::put('/games/{game}', [GameController::class, 'update']);
        Route::delete('/games/{game}', [GameController::class, 'destroy']);

        Route::post('/races', [RaceController::class, 'store']);
        Route::put('/races/{race}', [RaceController::class, 'update']);
        Route::delete('/races/{race}', [RaceController::class, 'destroy']);

        Route::post('/classes', [ClassController::class, 'store']);
        Route::put('/classes/{class}', [ClassController::class, 'update']);
        Route::delete('/classes/{class}', [ClassController::class, 'destroy']);

        Route::post('/books', [BookController::class, 'store']);
        Route::put('/books/{book}', [BookController::class, 'update']);
        Route::delete('/books/{book}', [BookController::class, 'destroy']);

        Route::get('/users', [UserController::class, 'index']);
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::post('/users/{user}/suspend', [UserController::class, 'suspend']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
    });
});

// Email verification
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])
    ->middleware(['signed'])->name('verification.verify');
