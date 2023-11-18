<?php

namespace App\Services\Master;

use App\Filters\Master\SkillFilter;
use App\Repositories\Master\SkillRepository;
use App\Services\BaseService;

class SkillService extends BaseService
{
    public function __construct(SkillRepository $repo, SkillFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Skill';
        $this->filterClass = $filter;
    }
}
