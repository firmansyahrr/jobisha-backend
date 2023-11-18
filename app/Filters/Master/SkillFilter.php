<?php

namespace App\Filters\Master;

use App\Filters\BaseFilter;
use App\Models\Master\Skill;

class SkillFilter extends BaseFilter
{
    public function __construct(Skill $model)
    {
        $this->model = $model;
    }

    public function filterQ($builder, $value)
    {
        $fields = ['title', 'company.name', 'job_role.label', 'job_specialization.label'];
        $builder = $this->qFilterFormatter($builder, $value, $fields);
        return $builder;
    }

    //
    public function filterCompanySlug($builder, $value)
    {
        return $builder->whereHas('company', function ($q) use ($value) {
            $q->where('slug', $value);
        });
    }
}
