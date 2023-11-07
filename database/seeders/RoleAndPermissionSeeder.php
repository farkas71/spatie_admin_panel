<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // USER MODEL
        $userPermission1 = Permission::create(['name' => 'create users']);
        $userPermission2 = Permission::create(['name' => 'read users']);
        $userPermission3 = Permission::create(['name' => 'update users']);
        $userPermission4 = Permission::create(['name' => 'delete users']);

        // ROLE MODEL
        $rolePermission1 = Permission::create(['name' => 'create roles']);
        $rolePermission2 = Permission::create(['name' => 'read roles']);
        $rolePermission3 = Permission::create(['name' => 'update roles']);
        $rolePermission4 = Permission::create(['name' => 'delete roles']);

        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'create permissions']);
        $permission2 = Permission::create(['name' => 'read permissions']);
        $permission3 = Permission::create(['name' => 'update permissions']);
        $permission4 = Permission::create(['name' => 'delete permissions']);

        // OTHER MODEL
        $otherPermission1 = Permission::create(['name' => 'admin_menu']);
        $otherPermission2 = Permission::create(['name' => 'admin_dashboard']);


        Role::create(['name' => 'superadmin'])
            ->syncPermissions(Permission::all());


        Role::create(['name' => 'admin'])
            ->syncPermissions([
                $userPermission1,
                $userPermission2,
                $userPermission3,

                $rolePermission2,
                
                $permission2,
                
                $otherPermission1,
                $otherPermission2,
            ]);


        Role::create(['name' => 'user'])
        ->syncPermissions([
            // $otherPermission1,
        ]);
    }
}
