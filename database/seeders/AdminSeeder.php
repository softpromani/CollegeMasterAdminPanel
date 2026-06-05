<?php

namespace Database\Seeders;

use App\Models\User;
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
        $adminRole = Role::where('name', 'admin')->first();

        $user = User::create([

            'email' => 'lnmu@gmail.com',

            'first_name' => 'LNMU',

            'last_name' => 'Admin',

            'phone' => '123456789',

            'role_id' => $adminRole->id,

            'password' => Hash::make('12345'),

        ]);

        $user->assignRole('admin');
    }

}
