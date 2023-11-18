<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\ApplicationParameterService;
use Illuminate\Http\Request;

class ApplicationParameterController extends Controller
{
    protected $service;
    public function __construct(ApplicationParameterService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        
        $object = $request->segment(3);

        return $this->service->allByType($request->all(), $object);
    }
}
