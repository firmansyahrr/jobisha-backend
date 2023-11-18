<?php

namespace App\Repositories\Master;

use App\Models\Master\Skill;
use App\Repositories\BaseRepository;

class SkillRepository extends BaseRepository
{
    public function __construct(Skill $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
