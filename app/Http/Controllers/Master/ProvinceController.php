<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\ProvinceService;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    protected $service;
    public function __construct(ProvinceService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        
        return $this->service->all($request->all());
    }
}
