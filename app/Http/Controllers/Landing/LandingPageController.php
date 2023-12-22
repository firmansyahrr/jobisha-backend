<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Services\General\TestimonyService;
use App\Services\Job\JobService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    use ApiResponseTrait;

    protected $jobService;

    public function __construct(TestimonyService $service, JobService $jobService)
    {
        $this->service = $service;
        $this->jobService = $jobService;
    }

    public function getTestimony(Request $request)
    {

        return $this->service->all($request->all());
    }

    public function getCounter(Request $request)
    {

        $datas = ['data' => [[
            'registerd_candidates' => rand(1000, 5000),
            'registerd_companies' => rand(1000, 5000),
            'submitted_jobs' => rand(1000, 5000)
        ]]];
        $success = $datas;

        return $this->successResponse($success, __('content.message.default.success'));
    }

    public function getPopularJob(Request $request)
    {

        $datas = [
            'data' => [
                [
                    'company_id' => rand(1, 10),
                    'title' => 'Graphic Designer',
                    'job_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'requirement' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'min_sallary' => '1854784.00',
                    'max_sallary' => '3174478.00',
                    'company' => [
                        'name' => 'Netflix'
                    ],
                    'job_type' => [
                        "id" => 19,
                        "type" => "job_type",
                        "code" => "jt_fulltime",
                        "label" => "Full Time",
                    ],
                    'job_preferences' => [
                        [
                            'id' => '1',
                            'code' => 'remote',
                            'name' => 'Remote'
                        ],
                        [
                            'id' => '2',
                            'code' => 'hybrid',
                            'name' => 'Hybrid'
                        ]
                    ],
                    'job_locations' => [
                        [
                            "name" => "JAKARTA PUSAT",
                        ]
                    ]
                ],
                [
                    'company_id' => rand(1, 10),
                    'title' => 'Graphic Designer',
                    'job_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'requirement' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'min_sallary' => '1854784.00',
                    'max_sallary' => '3174478.00',
                    'company' => [
                        'name' => 'Netflix'
                    ],
                    'job_type' => [
                        "id" => 19,
                        "type" => "job_type",
                        "code" => "jt_fulltime",
                        "label" => "Full Time",
                    ],
                    'job_preferences' => [
                        [
                            'id' => '1',
                            'code' => 'remote',
                            'name' => 'Remote'
                        ],
                        [
                            'id' => '2',
                            'code' => 'hybrid',
                            'name' => 'Hybrid'
                        ]
                    ],
                    'job_locations' => [
                        [
                            "name" => "JAKARTA PUSAT",
                        ]
                    ]
                ],
                [
                    'company_id' => rand(1, 10),
                    'title' => 'Graphic Designer',
                    'job_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'requirement' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'min_sallary'=> '1854784.00',
                    'max_sallary'=> '3174478.00',
                    'company' => [
                        'name' => 'Netflix'
                    ],
                    'job_type' => [
                        "id" => 19,
                        "type" => "job_type",
                        "code" => "jt_fulltime",
                        "label" => "Full Time",
                    ],
                    'job_preferences' => [
                        [
                            'id' => '1',
                            'code' => 'remote',
                            'name' => 'Remote'
                        ],
                        [
                            'id' => '2',
                            'code' => 'hybrid',
                            'name' => 'Hybrid'
                        ]
                    ],
                    'job_locations' => [
                        [
                            "name" => "JAKARTA PUSAT",
                        ]
                    ]
                ],
            ],
            'links' => [
                "first" => "http://127.0.0.1:4123/api/landing/popular-jobs?page=1",
                "last" => "http://127.0.0.1:4123/api/landing/popular-jobs?page=1",
                "prev" => null,
                "next" => "http://127.0.0.1:4123/api/landing/popular-jobs?page=1"
            ],
            'meta' => [
                "current_page" => 1,
                "from" => 1,
                "last_page" => 2,
                "path" => "http://127.0.0.1:4123/api/landing/popular-jobs",
                "per_page" => 10,
                "to" => 10,
                "total" => 20
            ]
        ];

        $success = $datas;

        return $this->successResponse($success, __('content.message.default.success'));
    }
}
