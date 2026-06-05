<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();



        $modules = [

            'dashboard',
            'user',
            'role',
            'permission',
          'designation',
            'employee',
            'banner',
            'notice',
            'event',



        ];


        foreach ($modules as $module) {

            Permission::firstOrCreate([
                'name' => $module
            ]);

            Permission::firstOrCreate([
                'name' => $module . '_view'
            ]);

            Permission::firstOrCreate([
                'name' => $module . '_create'
            ]);

            Permission::firstOrCreate([
                'name' => $module . '_edit'
            ]);

            Permission::firstOrCreate([
                'name' => $module . '_delete'
            ]);
        }
    }
}
