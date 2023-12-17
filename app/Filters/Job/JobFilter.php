<?php

namespace App\Filters\Job;

use App\Filters\BaseFilter;
use App\Models\General\Testimony;
use App\Models\Job\Job;

class JobFilter extends BaseFilter
{
    public function __construct(Job $model)
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

    public function filterCompany($builder, $value){
        return $builder->whereHas('company', function ($qry) use ($value) {
            $qry->whereRaw("UPPER(name) LIKE ?", ["%" . strtoupper($value) . '%']);
        });
    }

    public function filterJobRole($builder, $value){
        return $builder->whereHas('job_role', function ($qry) use ($value) {
            $qry->whereRaw("UPPER(label) LIKE ?", ["%" . strtoupper($value) . '%']);
        });
    }

    public function filterJobSpecialization($builder, $value){
        return $builder->whereHas('job_specialization', function ($qry) use ($value) {
            $qry->whereRaw("UPPER(label) LIKE ?", ["%" . strtoupper($value) . '%']);
        });
    }

    public function filterLocation($builder, $value){
        return $builder->whereHas('job_locations', function ($qry) use ($value) {
            $qry->whereRaw("UPPER(name) LIKE ?", ["%" . strtoupper($value) . '%']);
        });
    }

    public function filterCareerLevel($builder, $value){
        return $builder->whereHas('career_level', function ($qry) use ($value) {
            $qry->whereRaw("UPPER(label) LIKE ?", ["%" . strtoupper($value) . '%']);
        });
    }
}
