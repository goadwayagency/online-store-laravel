<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function getAllRoles(): Collection
    {
        return Cache::remember('all_roles', 3600, function () {
            return Role::with('permissions')->get();
        });
    }

    public function getRoleWithPermissions(string $roleId): Role
    {
        return Cache::remember("role_{$roleId}_permissions", 3600, function () use ($roleId) {
            return Role::with('permissions')->findOrFail($roleId);
        });
    }

    public function createRole(array $data): Role
    {
        return DB::transaction(function () use ($data) {
            $role = Role::create($data);
            
            if (isset($data['permissions'])) {
                $this->syncPermissions($role->id, $data['permissions']);
            }
            
            return $role->load('permissions');
        });
    }

    public function updateRole(string $roleId, array $data): Role
    {
        return DB::transaction(function () use ($roleId, $data) {
            $role = Role::findOrFail($roleId);
            $role->update($data);
            
            if (isset($data['permissions'])) {
                $this->syncPermissions($roleId, $data['permissions']);
            }
            
            return $role->fresh('permissions');
        });
    }

    public function deleteRole(string $roleId): void
    {
        DB::transaction(function () use ($roleId) {
            $role = Role::findOrFail($roleId);
            $role->delete(); // This will cascade delete role_permissions due to foreign key
        });
    }

    public function syncPermissions(string $roleId, array $permissionIds): void
    {
        $role = Role::findOrFail($roleId);
        $role->permissions()->sync($permissionIds);
    }

    public function addPermissionToRole(string $roleId, string $permissionId): RolePermission
    {
        $role = Role::findOrFail($roleId);
        $permission = Permission::findOrFail($permissionId);
        
        return RolePermission::create([
            'role_id' => $roleId,
            'permission_id' => $permissionId
        ]);
    }

    public function removePermissionFromRole(string $roleId, string $permissionId): bool
    {
        return RolePermission::where('role_id', $roleId)
            ->where('permission_id', $permissionId)
            ->delete() > 0;
    }

    public function getRolePermission(string $roleId, string $permissionId): ?RolePermission
    {
        return RolePermission::where('role_id', $roleId)
            ->where('permission_id', $permissionId)
            ->first();
    }

    public function getAllPermissions(): Collection
    {
        return Cache::remember('all_permissions', 3600, function () {
            return Permission::all();
        });
    }

    public function getRolePermissionsWithDetails(string $roleId): Collection
    {
        return Cache::remember("role_{$roleId}_permissions_detailed", 3600, function () use ($roleId) {
            return RolePermission::with(['role', 'permission'])
                ->where('role_id', $roleId)
                ->get();
        });
    }
}