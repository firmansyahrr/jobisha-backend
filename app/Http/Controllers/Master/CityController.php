<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\CityService;
use App\Services\Master\ProvinceService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $service;
    public function __construct(CityService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request, $province_id)
    {
        $req = $request->all();
        $req['province'] = $province_id;
        return $this->service->all($req);
    }
}
