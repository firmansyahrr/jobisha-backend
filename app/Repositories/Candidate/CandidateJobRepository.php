<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate\Candidate;
use App\Models\Candidate\CandidateJob;
use App\Repositories\BaseRepository;

class CandidateJobRepository extends BaseRepository
{
    public function __construct(CandidateJob $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
