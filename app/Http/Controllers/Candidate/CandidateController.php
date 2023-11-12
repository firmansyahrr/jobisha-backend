<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Candidate\CandidateApplyJobRequest;
use App\Http\Requests\Candidate\CandidateUpdateAboutMeRequest;
use App\Http\Requests\Candidate\CandidateUpdateEducationRequest;
use App\Http\Requests\Candidate\RegisterCandidateRequest;
use App\Services\Candidate\CandidateService;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    protected $service;
    public function __construct(CandidateService $service)
    {
        $this->service = $service;
    }

    public function profile(Request $request)
    {
        return $this->service->profile($request);
    }

    public function register(RegisterCandidateRequest $request)
    {
        return $this->service->register($request);
    }

    public function postUpdateAboutMe(CandidateUpdateAboutMeRequest $request)
    {
        return $this->service->updateAboutMe($request);
    }

    public function postUpdateEducation(CandidateUpdateEducationRequest $request)
    {
        return $this->service->updateEducation($request);
    }

    public function postSaveJob(Request $request, $slug)
    {
        return $this->service->saveJob($request, $slug);
    }

    public function postApplyJob(CandidateApplyJobRequest $request, $slug)
    {
        return $this->service->applyJob($request, $slug);
    }
}
