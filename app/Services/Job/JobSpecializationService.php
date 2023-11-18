<?php

namespace App\Services\Job;

use App\Filters\Job\JobSpecializationFilter;
use App\Repositories\Job\JobSpecializationRepository;
use App\Services\BaseService;

class JobSpecializationService extends BaseService
{
    public function __construct(JobSpecializationRepository $repo, JobSpecializationFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Job Specialization';
        $this->filterClass = $filter;
        $this->indexWith = [];
        $this->detailWith = [];
    }
}
