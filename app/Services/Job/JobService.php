<?php

namespace App\Services\Job;

use App\Filters\Job\JobFilter;
use App\Repositories\Job\JobRepository;
use App\Services\BaseService;

class JobService extends BaseService
{
    public function __construct(JobRepository $repo, JobFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Job';
        $this->filterClass = $filter;
        $this->indexWith = [
            'company',
            'job_type',
            'career_level',
            'job_role',
            'job_specialization',
            'job_preferences',
            'job_locations'
        ];

        $this->detailWith = [
            'company',
            'job_type',
            'career_level',
            'job_role',
            'job_specialization',
            'job_preferences',
            'job_locations'
        ];
    }

    public function getBySlug($slug)
    {
        $data = $this->repo->with($this->detailWith)->get(['slug' => $slug])->first();
        $success['data'] = [];
        if (isset($data)) {
            $success['data'] = [$data];
        }

        return $this->successResponse($success, __('content.message.default.success'));
    }
}
