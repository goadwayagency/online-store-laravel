<?php

namespace App\Observers;

use App\Models\RolePermission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class RolePermissionObserver
{
    /**
     * Handle the RolePermission "created" event.
     */
    public function created(RolePermission $rolePermission): void
    {
        $this->clearRoleCaches($rolePermission->role_id);
        
        // Optional: Add simple logging if needed
        \Log::info('Permission added to role', [
            'role_id' => $rolePermission->role_id,
            'permission_id' => $rolePermission->permission_id,
            'user_id' => Auth::id() // Safely get authenticated user ID
        ]);
    }

    /**
     * Handle the RolePermission "deleted" event.
     */
    public function deleted(RolePermission $rolePermission): void
    {
        $this->clearRoleCaches($rolePermission->role_id);
        
        // Optional: Add simple logging if needed
        \Log::info('Permission removed from role', [
            'role_id' => $rolePermission->role_id,
            'permission_id' => $rolePermission->permission_id,
            'user_id' => Auth::id() // Safely get authenticated user ID
        ]);
    }

    private function clearRoleCaches(string $roleId): void
    {
        Cache::forget('all_roles');
        Cache::forget("role_{$roleId}_permissions");
        Cache::forget("role_{$roleId}_permissions_detailed");
    }
}