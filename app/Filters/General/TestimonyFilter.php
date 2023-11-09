<?php

namespace App\Filters\General;

use App\Filters\BaseFilter;
use App\Models\General\Testimony;

class TestimonyFilter extends BaseFilter
{
    public function __construct(Testimony $model)
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
