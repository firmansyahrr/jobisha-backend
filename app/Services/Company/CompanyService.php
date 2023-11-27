<?php

namespace App\Services\Company;

use App\Filters\Company\CompanyFilter;
use App\Repositories\Company\CompanyRepository;
use App\Services\BaseService;

class CompanyService extends BaseService
{
    public function __construct(CompanyRepository $repo, CompanyFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Company';
        $this->filterClass = $filter;
        $this->indexWith = [
            'province',
            'city',
            'employe_size',
            'company_industry',
        ];

        $this->detailWith = [
            'province',
            'city',
            'employe_size',
            'company_industry',
        ];
    }

    public function getBySlug($slug)
    {
        $data = $this->repo->with($this->detailWith)->get(['slug' => $slug])->first();
        $success['data'] = [];
        if(isset($data)){
            $success['data'] = $data;
        }

        return $this->successResponse($success, __('content.message.default.success'));
    }
}
