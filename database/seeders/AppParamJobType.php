<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppParamJobType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['type' => 'job_types', 'code' => 'jt_fulltime', 'label' => 'Full Time',],
            ['type' => 'job_types', 'code' => 'jt_parttime', 'label' => 'Part Time',],
            ['type' => 'job_types', 'code' => 'jt_contract', 'label' => 'Contract',],
            ['type' => 'job_types', 'code' => 'jt_internship', 'label' => 'Internship',],
            ['type' => 'job_types', 'code' => 'jt_project', 'label' => 'Project',],
        ]);

        $lists->map(function ($list) {
            ApplicationParameter::firstOrCreate(
                [
                    'type' => $list['type'],
                    'code' => $list['code'],
                ],
                $list
            );
        });
    }
}
