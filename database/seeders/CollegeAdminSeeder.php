<?php

namespace CollegeAdmin\Database\Seeders;

use Illuminate\Database\Seeder;

class CollegeAdminSeeder extends Seeder
{
    /**
     * Run all package database seeds.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            AdminSeeder::class,
            BannerSeeder::class,
        ]);
    }
}
