<?php

namespace App\Observers;

use App\Models\Role;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        Cache::forget('all_roles');
        
        \Log::info('Role created', [
            'role_id' => $role->id,
            'role_name' => $role->name,
            'user_id' => Auth::id()
        ]);
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        Cache::forget('all_roles');
        Cache::forget("role_{$role->id}_permissions");
        
        \Log::info('Role updated', [
            'role_id' => $role->id,
            'role_name' => $role->name,
            'user_id' => Auth::id()
        ]);
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        Cache::forget('all_roles');
        
        \Log::info('Role deleted', [
            'role_id' => $role->id,
            'role_name' => $role->name,
            'user_id' => Auth::id()
        ]);
    }
}