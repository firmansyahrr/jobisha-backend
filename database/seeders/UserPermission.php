<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = collect([
            //     // ['name' => 'view_job', 'module_name' => 'job',],
            ['name' => 'create_job', 'module_name' => 'job',],
            //     // ['name' => 'update_job', 'module_name' => 'job',],
            //     // ['name' => 'delete_job', 'module_name' => 'job',],
            //     // ['name' => 'save_job', 'module_name' => 'job',],
            //     // ['name' => 'apply_job', 'module_name' => 'job',],
            //     // ['name' => 'search_job', 'module_name' => 'job',],

            //     // ['name' => 'search_candidate', 'module_name' => 'candidate',],
            ['name' => 'create_candidate', 'module_name' => 'candidate',],
            ['name' => 'update_candidate', 'module_name' => 'candidate',],
            //     // ['name' => 'update_profile_candidate', 'module_name' => 'candidate',],
        ]);

        $api = collect([]);

        $permissions->map(function ($permission) use ($api) {
            $api->push([
                'name' => $permission['name'],
                'module_name' => $permission['module_name'],
                'guard_name' => 'api',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        $datas = $api->toArray();

        foreach ($datas as $data) {
            Permission::updateOrCreate(['name' => $data['name']], $data);
        }

    }
}
