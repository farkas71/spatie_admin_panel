<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function list()
    {
        // minden elem lista
        $rolesWithPermissions = Role::with('permissions')->get();
        return view('roles.list', compact('rolesWithPermissions'));
    }

    public function create()
    {
        // új rekord felvitelhez ürlap megnyitás
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function createProces(Request $request)
    {
        // új rekord mentése adatbázisba
        $role = Role::create(['name' => $request->role_name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.list')->with('success', 'Szerepkör létrehozva!');

    }

    public function edit(string $roleName)
    {
        // adott rekord szerkesztéshez ürlap megnyitás
        $role = Role::where('name', $roleName)->first();
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->all();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function editProces(Request $request)
    {
        $role = Role::where('name', $request->role_name)->first();

        if ($role) {
            // név módosítás, ha a szerepkör létezik
            $role->name = $request->role_name;
            $role->save();

            // permissionok szinkronizálása
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.list')->with('success', 'Szerepkör módosítva!');
    }

    public function destroy(string $id)
    {
        // adott rekord törlése
        return redirect()->route('roles.list');
    }

    public function trashPosts()
    {
        // törölt rekordok
        // $category = Category::onlyTrashed()->get();
        return view('roles.trash');
    }
}
