<?php

namespace App\Filters\General;

use App\Filters\BaseFilter;
use App\Models\General\ContactUs;

class ContactUsFilter extends BaseFilter
{
    public function __construct(ContactUs $model)
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
