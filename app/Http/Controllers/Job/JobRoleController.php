<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Services\Job\JobRoleService;
use App\Services\Job\JobSpecializationService;
use Illuminate\Http\Request;

class JobRoleController extends Controller
{
    public function __construct(JobRoleService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        
        return $this->service->all($request->all());
    }
}
