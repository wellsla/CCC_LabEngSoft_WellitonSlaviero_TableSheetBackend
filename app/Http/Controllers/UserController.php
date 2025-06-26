<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $query = User::withTrashed();

        // Filter by name (search in name, username, or email)
        if ($request->has('name')) {
            $name = $request->get('name');
            $query->where(function($q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%')
                  ->orWhere('username', 'like', '%' . $name . '%')
                  ->orWhere('email', 'like', '%' . $name . '%');
            });
        }

        // Filter by status (suspended, active, deleted)
        if ($request->has('status')) {
            $status = $request->get('status');
            if ($status === 'suspended') {
                $query->where('is_suspended', true)->whereNull('deleted_at');
            } elseif ($status === 'active') {
                $query->where('is_suspended', false)->whereNull('deleted_at');
            } elseif ($status === 'deleted') {
                $query->whereNotNull('deleted_at');
            }
        }

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        // Validate sort field
        $allowedSortFields = ['name', 'username', 'email', 'created_at', 'updated_at'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortDirection === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $users = $query->paginate($perPage);

        return $this->paginatedResponse($users, 'Users retrieved successfully');
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return $this->notFoundResponse('Usuário não encontrado. O ID informado não existe ou foi removido.');
        }

        $data = $request->only([
            'username', 'name', 'email', 'birth_date', 'avatar_url', 'is_admin', 'is_suspended'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return $this->updatedResponse($user->fresh(), 'Usuário atualizado com sucesso');
    }

    public function suspend($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return $this->notFoundResponse('Usuário não encontrado. O ID informado não existe ou foi removido.');
        }

        $user->update(['is_suspended' => true]);

        // Revoke all tokens
        $user->tokens()->delete();

        return $this->updatedResponse($user->fresh(), 'Usuário suspenso com sucesso');
    }

    public function destroy($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return $this->notFoundResponse('Usuário não encontrado. O ID informado não existe ou foi removido.');
        }

        // Revoke all tokens before deletion
        $user->tokens()->delete();

        $user->delete();

        return $this->deletedResponse('Usuário excluído com sucesso');
    }
}
