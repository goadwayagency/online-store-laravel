<?php

namespace App\Observers;

use App\Models\Permission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $permission): void
    {
        Cache::forget('all_permissions');
        
        \Log::info('Permission created', [
            'permission_id' => $permission->id,
            'permission' => $permission->controller . '@' . $permission->action,
            'user_id' => Auth::id()
        ]);
    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {
        Cache::forget('all_permissions');
        
        \Log::info('Permission updated', [
            'permission_id' => $permission->id,
            'permission' => $permission->controller . '@' . $permission->action,
            'user_id' => Auth::id()
        ]);
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $permission): void
    {
        Cache::forget('all_permissions');
        
        \Log::info('Permission deleted', [
            'permission_id' => $permission->id,
            'permission' => $permission->controller . '@' . $permission->action,
            'user_id' => Auth::id()
        ]);
    }
}