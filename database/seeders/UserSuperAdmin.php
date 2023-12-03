<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@jobisha.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => 'super-admin',
            ]
        ]);

        $users->map(function ($user) {
            $user = collect($user);
            $newUser = User::updateOrCreate(['email' => $user['email']], $user->except('role')->toArray());
            $newUser->assignRole($user['role']);
        });
    }
}