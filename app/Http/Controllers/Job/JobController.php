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
        if (!$request->ajax()) {
            return redirect('/');
        }

        return $this->service->all($request->all());
    }

    public function getBySlug(Request $request, $slug)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        return $this->service->getBySlug($slug);
    }

    public function getByCompany(Request $request, $slug)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        $request = $request->all();
        $request['company_slug'] = $slug;
        return $this->service->all($request);
    }
}
