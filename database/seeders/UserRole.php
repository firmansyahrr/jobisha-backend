<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'super-admin',
            'company-admin',
            'candidate',
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'guard_name' => 'api',
            ]);
        }

        $superAdminWeb = Role::where(['name' => 'super-admin', 'guard_name' => 'api'])->firstOrFail();
        $superAdminWeb->givePermissionTo(Permission::where('guard_name', 'api')->get());
    }
}
