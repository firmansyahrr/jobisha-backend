<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Services\Job\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(JobService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {


        return $this->service->all($request->all());
    }

    public function getBySlug(Request $request, $slug)
    {


        return $this->service->getBySlug($slug);
    }

    public function getByCompany(Request $request, $slug)
    {


        $request = $request->all();
        $request['company_slug'] = $slug;
        return $this->service->all($request);
    }
}
