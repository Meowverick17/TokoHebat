<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Auth;

class AuthorizationHandler
{
    /**
     * 
     * @return bool
     */
    public function isAdmin($user = null)
    {
        $user = $user ?? Auth::user();
        
        if (!$user) {
            return false;
        }
        
        return $user->role === 'admin';
    }
    
    /**
     * 
     * @param int 
     * @return bool
     */
    public function canAccessUserData($targetUserId)
    {
        $currentUser = Auth::user();
        
        if (!$currentUser) {
            return false;
        }
        
        if ($this->isAdmin($currentUser)) {
            return true;
        }
        
        return $currentUser->id == $targetUserId;
    }

    public function hasRole($role, $user = null)
    {
        $user = $user ?? Auth::user();
        
        return $user && $user->role === $role;
    }
}