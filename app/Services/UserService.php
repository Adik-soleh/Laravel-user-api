<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class UserService
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function createUser(array $data)
    {
        return User::create(array_merge($data, ['id' => Str::uuid()]));
    }

    public function updateUser($id, array $data)
    {
        $user = User::find($id);
        if (!$user) return null;

        $user->update($data);
        return $user;
    }

    public function deleteUser($id): bool
    {
        $user = User::find($id);
        if (!$user) return false;

        $user->delete();
        return true;
    }
}
