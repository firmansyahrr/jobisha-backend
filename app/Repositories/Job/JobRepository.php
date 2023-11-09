<?php

namespace App\Repositories\Job;

use App\Models\Job\Job;
use App\Repositories\BaseRepository;

class JobRepository extends BaseRepository
{
    public function __construct(Job $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
