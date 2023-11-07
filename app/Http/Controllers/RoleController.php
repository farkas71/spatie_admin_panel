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

        return redirect()->route('roles.list')->with('success', 'Szerepkör létrehozva.');

    }

    public function show(string $id)
    {
        // adott rekord megjelenitése
    }

    public function edit(string $id)
    {
        // adott rekord szerkesztéshez ürlap megnyitás
        return view('roles.edit');
    }

    public function editProces(Request $request, string $id)
    {
        // adott rekord szerkesztésének mentése adatbázisba
        return redirect()->route('roles.list');
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
