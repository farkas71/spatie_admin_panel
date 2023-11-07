<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::prefix('/users')->middleware('permission:admin_menu')->group(function () {
        Route::get('/', [UserController::class, 'list'])->name('users.list');
        // Route::get('/{id}', [UserController::class, 'view'])->name('admin.users.user.view');
        // Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.users.user.edit');
        // Route::put('/edit-process', [UserController::class, 'editProcess'])->name('admin.users.user.edit.process');
        // Route::get('/{id}/delete', [UserController::class, 'delete'])->name('admin.users.user.delete');
    });

    Route::prefix('/roles')->middleware('permission:admin_menu')->group(function () {
        Route::get('/', [RoleController::class, 'list'])->name('roles.list');
        Route::get('/uj', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/uj', [RoleController::class, 'createProces'])->name('roles.add');
        Route::get('/szerkeszt/{roleName}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/szerkeszt/{roleName}', [RoleController::class, 'editProces'])->name('roles.editProces');



    });

    Route::prefix('/permissions')->middleware('permission:admin_menu')->group(function () {
        Route::get('/', [PermissionController::class, 'list'])->name('permissions.list');
    });


});

require __DIR__.'/auth.php';
