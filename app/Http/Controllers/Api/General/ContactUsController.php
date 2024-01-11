<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\ContactUsRequest;
use App\Services\General\ContactUsService;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function __construct(ContactUsService $service)
    {
        $this->service = $service;
    }

    public function create(ContactUsRequest $request)
    {
        return $this->service->create($request->all());
    }
}
