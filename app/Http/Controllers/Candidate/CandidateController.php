<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Candidate\CandidateApplyJobRequest;
use App\Http\Requests\Candidate\CandidateUpdateAboutMeRequest;
use App\Http\Requests\Candidate\CandidateUpdateEducationRequest;
use App\Http\Requests\Candidate\CandidateUpdateResumeRequest;
use App\Http\Requests\Candidate\CandidateUpdateSkillRequest;
use App\Http\Requests\Candidate\CandidateUpdateWorkExperienceRequest;
use App\Http\Requests\Candidate\CreateCandidateRequest;
use App\Http\Requests\Candidate\RegisterCandidateRequest;
use App\Models\Candidate\Candidate;
use App\Models\Job\JobRole;
use App\Models\Job\JobSpecialization;
use App\Models\Master\ApplicationParameter;
use App\Models\Master\City;
use App\Models\Master\Province;
use App\Services\Candidate\CandidateService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CandidateController extends Controller
{
    protected $service;
    public function __construct(CandidateService $service)
    {
        $this->service = $service;
    }

    public function indexWeb(Request $request)
    {
        $breadcrumbsItems = [
            [
                'name' => 'Candidate',
                'url' => route('candidate.index'),
                'active' => true
            ],
        ];

        $q = $request->get('q');
        $perPage = $request->get('per_page', 10);
        $sort = $request->get('sort');

        $datas = QueryBuilder::for(Candidate::class)
            ->allowedSorts(['name'])
            ->latest()
            ->paginate($perPage)
            ->appends(['per_page' => $perPage, 'q' => $q, 'sort' => $sort]);

        return view('pages.candidate.index', [
            'candidates' => $datas,
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Candidate'
        ]);
    }

    public function detailWeb(Request $request, $id)
    {
        $candidate = ($this->service->getData($id))->getData()->result->data;

        $applicationParams = ApplicationParameter::all();
        $jobRoles = JobRole::all();
        $jobSpecializations = JobSpecialization::all();

        $breadcrumbsItems = [
            [
                'name' => 'Candidate',
                'url' => route('candidate.index'),
                'active' => false
            ],
            [
                'name' => 'Detail',
                'url' => '#',
                'active' => true
            ],
        ];

        $q = $request->get('q');
        $perPage = $request->get('per_page', 10);
        $sort = $request->get('sort');

        return view('pages.candidate.detail', [
            'candidate' => $candidate,
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Candidate Detail',
            'applicationParams' => $applicationParams,
            'jobRoles' => $jobRoles,
            'jobSpecializations' => $jobSpecializations,
        ]);
    }

    public function createWeb(Request $request)
    {
        $provinces = Province::all();
        $cities = City::all();
        $genders = ApplicationParameter::where('type', 'genders')->get();

        $breadcrumbsItems = [
            [
                'name' => 'Candidate',
                'url' => route('candidate.index'),
                'active' => false
            ],
            [
                'name' => 'Create',
                'url' => '#',
                'active' => true
            ],
        ];

        return view('pages.candidate.create', [
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Candidate Create',
            'provinces' => $provinces,
            'cities' => $cities,
            'genders' => $genders,
        ]);
    }

    // =========================================================== Start of Super Admin
    public function index(Request $request)
    {
        return $this->service->all($request->all());
    }

    public function store(CreateCandidateRequest $request)
    {
        $register = $this->service->register($request, false);
        $candidate = $register->getData()->result->data;
        $candidate = Candidate::find($candidate->id)->first();
        $updateAboutMe = $this->service->processUpdateAboutMe($candidate, $request);

        return redirect()->route('candidate.detail', ['id' => $candidate->id])->with('message', 'Candidate registered successfully');
    }

    public function updateEducationWeb(CandidateUpdateEducationRequest $request, $id)
    {
        $candidate = Candidate::where('id',$id)->first();
        $updateEducation = $this->service->processUpdateEducation($candidate, $request);

        return redirect()->route('candidate.detail', ['id' => $candidate->id])->with('message', 'Candidate update successfully');
    }

    public function updateWorkExperienceWeb(CandidateUpdateWorkExperienceRequest $request, $id)
    {
        $candidate = Candidate::where('id',$id)->first();
        $updateWorkExperience = $this->service->processUpdateWorkExperience($candidate, $request);

        return redirect()->route('candidate.detail', ['id' => $candidate->id])->with('message', 'Candidate update successfully');
    }

    public function updateSkilleWeb(CandidateUpdateSkillRequest $request, $id)
    {
        $candidate = Candidate::where('id',$id)->first();
        $updateSkill = $this->service->processUpdateSkill($candidate, $request);

        return redirect()->route('candidate.detail', ['id' => $candidate->id])->with('message', 'Candidate update successfully');
    }

    public function updateResumeWeb(CandidateUpdateResumeRequest $request, $id)
    {
        $candidate = Candidate::where('id',$id)->first();
        $updateSkill = $this->service->processUpdateResume($candidate, $request);

        return redirect()->route('candidate.detail', ['id' => $candidate->id])->with('message', 'Candidate update successfully');
    }

    public function update(Request $request, $id)
    {
        // 
    }

    public function delete(Request $request, $id)
    {
        // 
    }
    // =========================================================== End of Super Admin

    public function userProfile(Request $request)
    {
        return $this->service->userProfile($request);
    }

    public function profile(Request $request)
    {
        return $this->service->profile($request);
    }

    public function register(RegisterCandidateRequest $request)
    {
        return $this->service->register($request, true);
    }

    public function postSaveJob(Request $request, $slug)
    {
        return $this->service->saveJob($request, $slug);
    }

    public function postUnSaveJob(Request $request, $slug)
    {
        return $this->service->unsaveJob($request, $slug);
    }

    public function postApplyJob(CandidateApplyJobRequest $request, $slug)
    {
        return $this->service->applyJob($request, $slug);
    }

    public function getJobSaved(Request $request)
    {
        return $this->service->getJobSaved($request);
    }

    public function getJobHistory(Request $request)
    {
        return $this->service->getJobHistory($request);
    }

    // ============================================== UPDATE PROFILE MANAGEMENT
    public function postUpdateAboutMe(CandidateUpdateAboutMeRequest $request)
    {
        return $this->service->updateAboutMe($request);
    }

    public function postUpdateEducation(CandidateUpdateEducationRequest $request)
    {
        return $this->service->updateEducation($request);
    }

    public function postUpdateWorkExperience(CandidateUpdateWorkExperienceRequest $request)
    {
        return $this->service->updateWorkExperience($request);
    }

    public function postUpdateSkill(CandidateUpdateSkillRequest $request)
    {
        return $this->service->updateSkill($request);
    }

    public function postUpdateResumes(CandidateUpdateResumeRequest $request)
    {
        return $this->service->updateResume($request);
    }

    public function deleteUpdateEducation(Request $request, $id)
    {
        return $this->service->deleteUpdateEducation($request, $id);
    }

    public function deleteUpdateWorkExperience(Request $request, $id)
    {
        return $this->service->deleteUpdateWorkExperience($request, $id);
    }

    public function deleteUpdateSkill(Request $request, $id)
    {
        return $this->service->deleteUpdateSkill($request, $id);
    }

    public function deleteUpdateResumes(Request $request, $id)
    {
        return $this->service->deleteUpdateResumes($request, $id);
    }
}
