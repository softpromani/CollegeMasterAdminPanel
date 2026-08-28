<?php

namespace CollegeAdmin\Database\Seeders;

use CollegeAdmin\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'first_name' => 'College',
                'last_name' => 'Admin',
                'phone' => '1234567890',
                'role_id' => $adminRole->id,
                'password' => Hash::make('123456'),
            ]
        );

        $user->assignRole('admin');
    }
}
