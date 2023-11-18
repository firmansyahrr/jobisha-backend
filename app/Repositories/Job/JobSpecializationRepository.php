<?php

namespace App\Repositories\Job;

use App\Models\Job\Job;
use App\Models\Job\JobSpecialization;
use App\Repositories\BaseRepository;

class JobSpecializationRepository extends BaseRepository
{
    public function __construct(JobSpecialization $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
