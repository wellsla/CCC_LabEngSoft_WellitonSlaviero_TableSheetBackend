<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Password reset route
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])
    ->name('password.reset');

Route::fallback(function () {
    abort(404);
});
