<?php

namespace App\Repositories\Master;

use App\Models\Master\ApplicationParameter;
use App\Models\Master\Skill;
use App\Repositories\BaseRepository;

class ApplicationParameterRepository extends BaseRepository
{
    public function __construct(ApplicationParameter $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
