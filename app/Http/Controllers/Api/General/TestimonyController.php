<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Services\General\TestimonyService;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function __construct(TestimonyService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        
        return $this->service->all($request->all());
    }
}
