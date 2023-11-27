<?php

namespace App\Filters\Master;

use App\Filters\BaseFilter;
use App\Models\Master\Province;

class ProvinceFilter extends BaseFilter
{
    public function __construct(Province $model)
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
