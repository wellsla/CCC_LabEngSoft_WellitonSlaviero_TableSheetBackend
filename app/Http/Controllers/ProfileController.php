<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @group Profile
 *
 * APIs for managing user profile information
 */
class ProfileController extends Controller
{
    /**
     * Get user profile
     *
     * Retrieve the authenticated user's profile information.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "username": "john_doe",
     *     "name": "John Doe",
     *     "email": "john@example.com",
     *     "birth_date": "1990-01-01",
     *     "avatar_url": "https://example.com/avatar.jpg",
     *     "is_admin": false,
     *     "is_suspended": false,
     *     "email_verified_at": "2024-01-01T12:00:00.000000Z",
     *     "created_at": "2024-01-01T12:00:00.000000Z",
     *     "updated_at": "2024-01-01T12:00:00.000000Z"
     *   }
     * }
     */
    public function show(Request $request)
    {
        return response()->json([
            'data' => $request->user()
        ]);
    }

    /**
     * Update user profile
     *
     * Update the authenticated user's profile information (excluding password).
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @bodyParam username string The unique username. Example: john_doe_updated
     * @bodyParam name string The user's full name. Example: John Doe Updated
     * @bodyParam email string The user's email address. Example: john.updated@example.com
     * @bodyParam birth_date string The user's birth date (YYYY-MM-DD). Example: 1990-01-01
     * @bodyParam avatar_url string The user's avatar URL. Example: https://example.com/new-avatar.jpg
     *
     * @response 200 {
     *   "message": "Profile updated successfully",
     *   "data": {
     *     "id": 1,
     *     "username": "john_doe_updated",
     *     "name": "John Doe Updated",
     *     "email": "john.updated@example.com",
     *     "birth_date": "1990-01-01",
     *     "avatar_url": "https://example.com/new-avatar.jpg",
     *     "is_admin": false,
     *     "is_suspended": false,
     *     "email_verified_at": null,
     *     "created_at": "2024-01-01T12:00:00.000000Z",
     *     "updated_at": "2024-01-01T13:00:00.000000Z"
     *   }
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "email": ["The email has already been taken."]
     *   }
     * }
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $originalEmail = $user->email;

        $data = $request->only(['username', 'name', 'email', 'birth_date', 'avatar_url']);

        // If email is being changed, reset email verification
        if (isset($data['email']) && $data['email'] !== $originalEmail) {
            $data['email_verified_at'] = null;
        }

        $user->update($data);

        // Send email verification if email was changed
        if (isset($data['email']) && $data['email'] !== $originalEmail) {
            $user->sendEmailVerificationNotification();
        }

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $user->fresh()
        ]);
    }

    /**
     * Change user password
     *
     * Change the authenticated user's password.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @bodyParam current_password string required The current password. Example: currentpassword123
     * @bodyParam password string required The new password (min 8 characters). Example: newpassword123
     * @bodyParam password_confirmation string required The new password confirmation. Example: newpassword123
     *
     * @response 200 {
     *   "message": "Password changed successfully"
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "current_password": ["A senha atual está incorreta."]
     *   }
     * }
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Senha alterada com sucesso.'
        ]);
    }
}
