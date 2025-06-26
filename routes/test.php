<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
| Here are test routes for development purposes only.
| These should be removed in production.
|
*/

Route::get('/test-mail', function () {
    try {
        Mail::raw('This is a test email from TableSheet application to verify Mailpit configuration.', function ($message) {
            $message->to('test@example.com')
                    ->subject('Mailpit Test Email - TableSheet');
        });

        return response()->json([
            'success' => true,
            'message' => 'Test email sent successfully! Check Mailpit dashboard at http://localhost:8025'
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to send test email: ' . $e->getMessage()
        ], 500);
    }
});
