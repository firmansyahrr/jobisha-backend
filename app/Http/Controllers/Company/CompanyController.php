<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\Company\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(CompanyService $service)
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
