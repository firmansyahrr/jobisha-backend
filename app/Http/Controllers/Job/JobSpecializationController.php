<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Services\Job\JobSpecializationService;
use Illuminate\Http\Request;

class JobSpecializationController extends Controller
{
    public function __construct(JobSpecializationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return $this->service->all($request->all());
    }
}
