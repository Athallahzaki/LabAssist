<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('role_code', Role::ADMIN_CODE)->first();

        DB::transaction(function () use ($adminRole) {

            $user = User::updateOrCreate(
                ['email' => 'admin@lab.local'],
                [
                    'username'  => 'admin',
                    'password'  => Hash::make('admin123'), // ganti setelah login
                    'role_id'   => $adminRole->id,
                    'is_active' => true,
                ]
            );

            Admin::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'display_name' => 'Administrator',
                ]
            );
        });
    }
}
