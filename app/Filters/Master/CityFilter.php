<?php

namespace App\Filters\Master;

use App\Filters\BaseFilter;
use App\Models\Master\City;

class CityFilter extends BaseFilter
{
    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function filterQ($builder, $value)
    {
        $fields = [];
        $builder = $this->qFilterFormatter($builder, $value, $fields);
        return $builder;
    }

    public function filterProvince($builder, $value)
    {
        return $builder->where('province_id', $value);
    }
}
