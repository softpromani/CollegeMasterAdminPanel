<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $superAdmin = Role::where('name', 'super_admin')
            ->first();

        $admin = Role::where('name', 'admin')
            ->first();

        $employee = Role::where('name', 'employee')
            ->first();

   

        $superAdmin?->syncPermissions(
            Permission::all()
        );

        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        $admin?->syncPermissions(

            Permission::whereNotIn('name', [

                'permission',
                'permission_view',
                'permission_create',
                'permission_edit',
                'permission_delete',

            ])->get()

        );

        /*
        |--------------------------------------------------------------------------
        | Employee
        |--------------------------------------------------------------------------
        */

        $employee?->syncPermissions(

            Permission::where('name', 'like', '%_view')
                ->get()

        );
    }
}
