<?php

namespace App\Services\General;

use App\Filters\General\TestimonyFilter;
use App\Repositories\General\TestimonyRepository;
use App\Services\BaseService;

class TestimonyService extends BaseService
{
    public function __construct(TestimonyRepository $repo, TestimonyFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Testimony';
        $this->filterClass = $filter;
    }
}
