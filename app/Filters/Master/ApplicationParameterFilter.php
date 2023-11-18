<?php

namespace App\Filters\Master;

use App\Filters\BaseFilter;
use App\Models\Master\ApplicationParameter;

class ApplicationParameterFilter extends BaseFilter
{
    public function __construct(ApplicationParameter $model)
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
    public function filterType($builder, $value)
    {
        return $builder->where('type', $value);
    }
}
