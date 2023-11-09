<?php

namespace App\Filters\Company;

use App\Filters\BaseFilter;
use App\Models\Companies\Company;
use App\Models\Job\Job;

class CompanyFilter extends BaseFilter
{
    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function filterQ($builder, $value)
    {
        $fields = [];
        $builder = $this->qFilterFormatter($builder, $value, $fields);
        return $builder;
    }

    //
}
