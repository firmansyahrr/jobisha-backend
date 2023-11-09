<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppParamCompanyIndustry extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['type' => 'company_industries', 'code' => 'cs_industry_1', 'label' => 'Finance / Banking',],
            ['type' => 'company_industries', 'code' => 'cs_industry_2', 'label' => 'Human Resource Management / Consulting',],
            ['type' => 'company_industries', 'code' => 'cs_industry_3', 'label' => 'General & Wholesale Trading',],
            ['type' => 'company_industries', 'code' => 'cs_industry_4', 'label' => 'Tax & Audit',],
            ['type' => 'company_industries', 'code' => 'cs_industry_5', 'label' => 'Telekomunikasi',],
            ['type' => 'company_industries', 'code' => 'cs_industry_6', 'label' => 'Textil / Garment',],
            ['type' => 'company_industries', 'code' => 'cs_industry_7', 'label' => 'Account',],
            ['type' => 'company_industries', 'code' => 'cs_industry_8', 'label' => 'Other',],
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
