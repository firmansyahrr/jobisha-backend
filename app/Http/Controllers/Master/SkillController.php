<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\ApplicationParameterService;
use App\Services\Master\SkillService;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    protected $service;
    public function __construct(SkillService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        
        return $this->service->all($request->all());
    }
}
