<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job\CreateJobRequest;
use App\Http\Requests\Job\CreateJobRequestWeb;
use App\Models\Companies\Company;
use App\Models\Job\Job;
use App\Models\Job\JobPreference;
use App\Models\Job\JobRole;
use App\Models\Job\JobSpecialization;
use App\Models\Master\ApplicationParameter;
use App\Models\Master\City;
use App\Models\Master\Province;
use App\Services\Job\JobService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class JobController extends Controller
{
    public function __construct(JobService $service)
    {
        $this->service = $service;
    }

    // ========================================================================= WEB
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

        $datas = QueryBuilder::for(Job::class)
            ->allowedSorts(['name'])
            ->latest()
            ->paginate($perPage)
            ->appends(['per_page' => $perPage, 'q' => $q, 'sort' => $sort]);

        return view('pages.job.index', [
            'jobs' => $datas,
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Job'
        ]);
    }

    public function detailWeb(Request $request, $id)
    {
        $job = ($this->service->getData($id))->getData()->result->data;

        $applicationParams = ApplicationParameter::all();

        $breadcrumbsItems = [
            [
                'name' => 'Job',
                'url' => route('job.index'),
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

        return view('pages.job.detail', [
            'job' => $job,
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Job Detail',
            'applicationParams' => $applicationParams,
        ]);
    }

    public function editWeb(Request $request, $id)
    {
        $job = ($this->service->getData($id))->getData()->result->data;

        $companies = Company::all();
        $provinces = Province::all();
        $cities = City::all();
        $applicationParams = ApplicationParameter::all();
        $jobSpecializations = JobSpecialization::all();
        $jobRoles = JobRole::all();

        $breadcrumbsItems = [
            [
                'name' => 'Job',
                'url' => route('job.index'),
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

        return view('pages.job.form', [
            'job' => $job,
            'breadcrumbItems' => $breadcrumbsItems,
            'action' => 'edit',
            'pageTitle' => 'Edit Job',
            'provinces' => $provinces,
            'cities' => $cities,
            'applicationParams' => $applicationParams,
            'jobRoles' => $jobRoles,
            'jobSpecializations' => $jobSpecializations,
            'companies' => $companies,
        ]);
    }

    public function createWeb(Request $request)
    {
        $companies = Company::all();
        $provinces = Province::all();
        $cities = City::all();
        $applicationParams = ApplicationParameter::all();
        $jobSpecializations = JobSpecialization::all();
        $jobRoles = JobRole::all();

        $breadcrumbsItems = [
            [
                'name' => 'Job',
                'url' => route('job.index'),
                'active' => false
            ],
            [
                'name' => 'Create',
                'url' => '#',
                'active' => true
            ],
        ];

        return view('pages.job.form', [
            'breadcrumbItems' => $breadcrumbsItems,
            'action' => 'create',
            'pageTitle' => 'Create Job',
            'provinces' => $provinces,
            'cities' => $cities,
            'applicationParams' => $applicationParams,
            'jobRoles' => $jobRoles,
            'jobSpecializations' => $jobSpecializations,
            'companies' => $companies,
        ]);
    }


    public function postCreateJobWeb(CreateJobRequestWeb $request)
    {
        $this->service->create($request->all());
        return redirect()->route('job.index')->with('message', 'Job registered successfully');
    }

    public function postUpdateJobWeb(Request $request, $id)
    {
        $this->service->update($request->all(), $id);
        return redirect()->route('job.detail', ['id' => $id])->with('message', 'Job registered successfully');
    }
    // ========================================================================= WEB

    public function index(Request $request)
    {
        return $this->service->all($request->all());
    }

    public function getBySlug(Request $request, $slug)
    {
        return $this->service->getBySlug($slug);
    }

    public function getByCompany(Request $request, $slug)
    {
        $request = $request->all();
        $request['company_slug'] = $slug;
        return $this->service->all($request);
    }

    public function postCreateJob(CreateJobRequest $request)
    {
        return $this->service->create($request->all());
    }
}
