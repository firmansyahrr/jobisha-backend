<?php

namespace App\Services\Job;

use App\Filters\Job\JobRoleFilter;
use App\Repositories\Job\JobRoleRepository;
use App\Services\BaseService;

class JobRoleService extends BaseService
{
    public function __construct(JobRoleRepository $repo, JobRoleFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Job Role';
        $this->filterClass = $filter;
        $this->indexWith = [];
        $this->detailWith = [];
    }
}
