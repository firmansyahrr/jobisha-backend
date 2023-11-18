<?php

namespace App\Filters\Job;

use App\Filters\BaseFilter;
use App\Models\General\Testimony;
use App\Models\Job\Job;
use App\Models\Job\JobRole;

class JobRoleFilter extends BaseFilter
{
    public function __construct(JobRole $model)
    {
        $this->model = $model;
    }

    public function filterQ($builder, $value)
    {
        $fields = [];
        $builder = $this->qFilterFormatter($builder, $value, $fields);
        return $builder;
    }
}
