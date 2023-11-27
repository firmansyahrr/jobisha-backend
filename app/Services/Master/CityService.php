<?php

namespace App\Services\Master;

use App\Filters\Master\CityFilter;
use App\Repositories\Master\CityRepository;
use App\Services\BaseService;

class CityService extends BaseService
{
    public function __construct(CityRepository $repo, CityFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Skill';
        $this->filterClass = $filter;
    }
}
