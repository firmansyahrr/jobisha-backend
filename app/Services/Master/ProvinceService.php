<?php

namespace App\Services\Master;

use App\Filters\Master\ProvinceFilter;
use App\Repositories\Master\ProvinceRepository;
use App\Services\BaseService;

class ProvinceService extends BaseService
{
    public function __construct(ProvinceRepository $repo, ProvinceFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Skill';
        $this->filterClass = $filter;
    }
}
