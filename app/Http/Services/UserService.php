<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'] ?? null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'customer',
        ]);
    }

    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function updatePassword($userId, string $newPassword)
    {
        $user = User::findOrFail($userId);
        $user->password = Hash::make($newPassword);
        $user->save();

        return $user;
    }
}