<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function doRegister(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'customer'
        ]);

        return [
            'success' => true,
            'data' => [
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role
            ]
        ];
    }

    public function doLogin(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return ['success' => false, 'message' => 'Email atau password salah'];
        }

        $user = Auth::user();

        return [
            'success' => true,
            'data' => [
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role
            ]
        ];
    }

    public function doLogout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
    }
