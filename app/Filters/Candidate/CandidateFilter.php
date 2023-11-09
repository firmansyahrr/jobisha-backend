<?php

namespace App\Filters\Candidate;

use App\Filters\BaseFilter;
use App\Models\Candidate\Candidate;

class CandidateFilter extends BaseFilter
{
    public function __construct(Candidate $model)
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
