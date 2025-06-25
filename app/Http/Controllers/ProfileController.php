<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'data' => $request->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'username' => 'string|unique:users,username,' . $user->id,
            'name' => 'string',
            'email' => 'string|email|unique:users,email,' . $user->id,
            'birth_date' => 'date',
            'avatar_url' => 'string|nullable',
            'password' => 'string|min:8|nullable',
        ]);

        $data = $request->only(['username', 'name', 'email', 'birth_date', 'avatar_url']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $user->fresh()
        ]);
    }
}
