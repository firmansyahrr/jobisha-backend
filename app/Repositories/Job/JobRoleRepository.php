<?php

namespace App\Repositories\Job;

use App\Models\Job\Job;
use App\Models\Job\JobRole;
use App\Repositories\BaseRepository;

class JobRoleRepository extends BaseRepository
{
    public function __construct(JobRole $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
