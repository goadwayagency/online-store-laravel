<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\Permission;
use App\Services\RoleService;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleController extends Controller
{
    // use AuthorizesRequests;

    // public function __construct(private RoleService $roleService) 
    // {
    //     $this->authorizeResource(Role::class, 'role');
    // }

    public function index(){
        $roles = Role::all();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    // ... existing index, create, store, show, edit, update, destroy methods ...

    // public function permissions(Role $role): View
    // {
    //     $rolePermissions = $this->roleService->getRolePermissionsWithDetails($role->id);
    //     $allPermissions = $this->roleService->getAllPermissions();
        
    //     return view('admin.roles.permissions', compact('role', 'rolePermissions', 'allPermissions'));
    // }

    // public function addPermission(Request $request, Role $role): RedirectResponse
    // {
    //     $request->validate([
    //         'permission_id' => 'required|exists:permissions,id'
    //     ]);

    //     $this->roleService->addPermissionToRole($role->id, $request->permission_id);

    //     return redirect()->route('admin.roles.permissions', $role)
    //         ->with('success', 'Permission added successfully.');
    // }

    // public function removePermission(Role $role, Permission $permission): RedirectResponse
    // {
    //     $this->roleService->removePermissionFromRole($role->id, $permission->id);

    //     return redirect()->route('admin.roles.permissions', $role)
    //         ->with('success', 'Permission removed successfully.');
    // }
}