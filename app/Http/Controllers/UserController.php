<?php

namespace App\Http\Controllers;

use App\Models\User;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        // minden elem lista
        $usersWithRoles = User::with('roles')->get();
        return view('users.list', compact('usersWithRoles'));

    }

    public function create()
    {
        // új rekord felvitelhez ürlap megnyitás
        return view('users.create');

    }

    public function createProces(Request $request)
    {
        // új rekord mentése adatbázisba
        return redirect()->route('users.list');

    }

    public function show(string $id)
    {
        // adott rekord megjelenitése
    }

    public function edit(string $id)
    {
        // adott rekord szerkesztéshez ürlap megnyitás
        return view('users.edit');

    }

    public function editProces(Request $request, string $id)
    {
        // adott rekord szerkesztésének mentése adatbázisba
        return redirect()->route('users.list');

    }

    public function destroy(string $id)
    {
        // adott rekord törlése
        return redirect()->route('users.list');

    }

    public function trashPosts()
    {
        // törölt rekordok
        // $category = Category::onlyTrashed()->get();
        return view('users.trash');

    }
}