<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function list()
    {
        // minden elem lista
        return view('roles.list');

    }

    public function create()
    {
        // új rekord felvitelhez ürlap megnyitás
        return view('roles.create');

    }

    public function createProces(Request $request)
    {
        // új rekord mentése adatbázisba
        return redirect()->route('roles.list');

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