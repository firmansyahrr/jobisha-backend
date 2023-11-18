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
}
