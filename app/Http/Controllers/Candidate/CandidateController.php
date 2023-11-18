<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Candidate\CandidateApplyJobRequest;
use App\Http\Requests\Candidate\CandidateUpdateAboutMeRequest;
use App\Http\Requests\Candidate\CandidateUpdateEducationRequest;
use App\Http\Requests\Candidate\CandidateUpdateSkillRequest;
use App\Http\Requests\Candidate\CandidateUpdateWorkExperienceRequest;
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
        if (!$request->ajax()) {
            return redirect('/');
        }
        
        return $this->service->profile($request);
    }

    public function register(RegisterCandidateRequest $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        
        return $this->service->register($request);
    }

    public function postSaveJob(Request $request, $slug)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        
        return $this->service->saveJob($request, $slug);
    }

    public function postApplyJob(CandidateApplyJobRequest $request, $slug)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        
        return $this->service->applyJob($request, $slug);
    }

    // ============================================== UPDATE PROFILE MANAGEMENT
    public function postUpdateAboutMe(CandidateUpdateAboutMeRequest $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        
        return $this->service->updateAboutMe($request);
    }

    public function postUpdateEducation(CandidateUpdateEducationRequest $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        
        return $this->service->updateEducation($request);
    }

    public function postUpdateWorkExperience(CandidateUpdateWorkExperienceRequest $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        
        return $this->service->updateWorkExperience($request);
    }

    public function postUpdateSkill(CandidateUpdateSkillRequest $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        
        return $this->service->updateSkill($request);
    }
}
