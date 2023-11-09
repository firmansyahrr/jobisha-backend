<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate\Candidate;
use App\Repositories\BaseRepository;

class CandidateRepository extends BaseRepository
{
    public function __construct(Candidate $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
