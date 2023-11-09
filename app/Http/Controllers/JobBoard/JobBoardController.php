<?php

namespace App\Http\Controllers\JobBoard;

use App\Http\Controllers\Controller;
use App\Services\Job\JobService;
use Illuminate\Http\Request;

class JobBoardController extends Controller
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
}
