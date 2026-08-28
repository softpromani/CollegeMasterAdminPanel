<?php

namespace CollegeAdmin\Database\Seeders;

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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

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
            'department',
            'faculty',
            'non-faculty',
            'aqar',
        ];

        foreach ($modules as $module) {
            Permission::firstOrCreate(['name' => $module, 'guard_name' => 'web']);
            Permission::firstOrCreate(['name' => $module . '_view', 'guard_name' => 'web']);
            Permission::firstOrCreate(['name' => $module . '_create', 'guard_name' => 'web']);
            Permission::firstOrCreate(['name' => $module . '_edit', 'guard_name' => 'web']);
            Permission::firstOrCreate(['name' => $module . '_delete', 'guard_name' => 'web']);
        }
    }
}
