<?php

namespace App\Services\Candidate;

use App\Filters\Candidate\CandidateFilter;
use App\Models\Candidate\CandidateProfileCompleteness;
use App\Repositories\Candidate\CandidateJobRepository;
use App\Repositories\Candidate\CandidateRepository;
use App\Repositories\Job\JobRepository;
use App\Repositories\Master\SkillRepository;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CandidateService extends BaseService
{
    protected $userRepo;
    protected $jobRepo;
    protected $candidateJobRepo;
    protected $skillRepo;
    public function __construct(CandidateRepository $repo, CandidateFilter $filter, UserRepository $userRepo, JobRepository $jobRepo, CandidateJobRepository $candidateJobRepo, SkillRepository $skillRepo)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Candidate';
        $this->filterClass = $filter;

        $this->userRepo = $userRepo;
        $this->jobRepo = $jobRepo;
        $this->candidateJobRepo = $candidateJobRepo;
        $this->skillRepo = $skillRepo;
    }

    public function getData($id)
    {
        $data = $this->repo->with(
            [
                'work_experiences.salary_range',
                'work_experiences.career_level',
                'work_experiences.job_type',
                'work_experiences.job_specialization',
                'work_experiences.job_role',

                'educations.education_level',

                'skills.skill_level',

                'resumes',
                'gender',
                'completeness'
            ]
        )->find($id);
        $success['data'] = $data;

        return $this->successResponse($success, __('content.message.default.success'));
    }

    public function userProfile(Request $request)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);

            // $user->getMedia();

            $success['data'] = $user;

            return $this->successResponse($success, __('content.message.read.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function profile(Request $request)
    {
        try {
            $user = $this->userRepo->with(
                [
                    'candidate.gender',

                    'candidate.work_experiences.salary_range',
                    'candidate.work_experiences.career_level',
                    'candidate.work_experiences.job_type',
                    'candidate.work_experiences.job_specialization',
                    'candidate.work_experiences.job_role',

                    'candidate.educations.education_level',

                    'candidate.skills.skill_level',

                    'candidate.resumes',
                    'candidate.gender',
                    'candidate.completeness'
                ]
            )->find($request->user()->id);

            // $user->getMedia();

            $success['data'] = $user;

            return $this->successResponse($success, __('content.message.read.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function register(Request $request, $isEmail = true)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $candidateData = Arr::except($data, ['password', 'confirm_password']);

            // Insert into candidate
            $candidate = $this->repo->create($candidateData);

            // Insert candidate profile pictures
            if ($request->hasFile('photo')) {
                $candidate->clearMediaCollection('profile-image');
                $candidate->addMediaFromRequest('photo')->toMediaCollection('profile-image');
            }

            // Insert into user
            $userData = Arr::only($data, ['name', 'email']);
            $userData['password'] = bcrypt($data['password']);
            $userData['candidate_id'] = $candidate->id;

            $user = $this->userRepo->create($userData);
            $user->assignRole('candidate');

            DB::commit();

            if ($isEmail) {
                event(new Registered($user));
            }

            $success['data'] = $candidate;

            CandidateProfileCompleteness::updateOrCreate(['activity' => 'create_account', 'candidate_id' => $candidate->id], ['activity' => 'create_account', 'label' => 'Create Account', 'candidate_id' => $candidate->id, 'is_complete' => true]);

            return $this->successResponse($success, __('content.message.register.success'), 201);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function saveJob(Request $request, $slug)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $job = $this->jobRepo->with($this->detailWith)->get(['slug' => $slug])->first();

            if (!$job) {
                throw new Exception(__('content.message.job.not_found'));
            }

            $candidateJob = $this->candidateJobRepo->findWhere([
                'candidate_id' => $candidate->id,
                'job_id' => $job->id,
                'type' => 'saved',
            ]);

            if ($candidateJob) {
                throw new Exception(__('content.message.job.save.already'));
            }

            $candidate->job()->updateOrCreate([
                'candidate_id' => $candidate->id,
                'job_id' => $job->id,
                'type' => 'saved'
            ], [
                'candidate_id' => $candidate->id,
                'job_id' => $job->id,
                'type' => 'saved'
            ]);

            $success['data'] = $candidate->refresh();

            return $this->successResponse($success, __('content.message.job.save.success'), 200);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse([], __('content.message.job.save.failed') . ': ' . $exc->getMessage());
        }
    }

    public function unsaveJob(Request $request, $slug)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $job = $this->jobRepo->with($this->detailWith)->get(['slug' => $slug])->first();

            if (!$job) {
                throw new Exception(__('content.message.job.not_found'));
            }

            $candidateJob = $this->candidateJobRepo->findWhere([
                'candidate_id' => $candidate->id,
                'job_id' => $job->id,
                'type' => 'saved',
            ]);

            if (!$candidateJob) {
                throw new Exception(__('content.message.job.unsave.not_save_yet'));
            }

            $candidate->job()->where('job_id', $job->id)->delete();

            $success['data'] = $candidate->refresh();

            return $this->successResponse($success, __('content.message.job.unsave.success'), 200);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse([], __('content.message.job.unsave.failed') . ': ' . $exc->getMessage());
        }
    }

    public function applyJob(Request $request, $slug)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $job = $this->jobRepo->with($this->detailWith)->get(['slug' => $slug])->first();

            if (!$job) {
                throw new Exception(__('content.message.job.not_found'));
            }

            $candidateJob = $this->candidateJobRepo->findWhere([
                'candidate_id' => $candidate->id,
                'job_id' => $job->id,
                'type' => 'applied',
            ]);

            if ($candidateJob) {
                throw new Exception(__('content.message.job.apply.already'));
            }

            $candidate->job()->updateOrCreate([
                'candidate_id' => $candidate->id,
                'job_id' => $job->id,
                'type' => 'applied',
            ], [
                'candidate_id' => $candidate->id,
                'job_id' => $job->id,
                'type' => 'applied',
                'description' => $request->description
            ]);

            $success['data'] = $candidate->refresh();

            return $this->successResponse($success, __('content.message.job.apply.success'), 200);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse([], __('content.message.job.apply.failed') . ': ' . $exc->getMessage());
        }
    }

    public function getJobSaved($request)
    {
        $indexWith = [
            'company',
            'job_type',
            'career_level',
            'job_role',
            'job_specialization',
            'job_preferences',
            'job_locations'
        ];
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $jobs = $candidate->job()->where('type', 'saved')->pluck('job_id');

            $req = $request->all();
            $req['job_ids'] = $jobs->implode(',');

            $datas = $this->jobRepo->with($indexWith)->all($req, $this->jobFilter);

            $success = $datas;

            return $this->successResponse($success, __('content.message.default.success'));
        } catch (\Throwable $th) {
            return $this->failedResponse([], $th->getMessage());
        }
    }

    public function getJobHistory($request)
    {

        $indexWith = [
            'company',
            'job_type',
            'career_level',
            'job_role',
            'job_specialization',
            'job_preferences',
            'job_locations'
        ];
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $jobs = $candidate->job()->where('type', 'applied')->pluck('job_id');

            $req = $request->all();
            $req['job_ids'] = $jobs->implode(',');

            $datas = $this->jobRepo->with($indexWith)->all($req, $this->jobFilter);

            $success = $datas;

            return $this->successResponse($success, __('content.message.default.success'));
        } catch (\Throwable $th) {
            return $this->failedResponse([], $th->getMessage());
        }
    }

    // ============================================================================== START UPDATE ABOUT ME ==============================================================================
    public function updateAboutMe(Request $request)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            return $this->processUpdateAboutMe($candidate, $request);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function processUpdateAboutMe($candidate, $request)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $candidate->clearMediaCollection('profile-image');
            $candidate->addMediaFromRequest('photo')->toMediaCollection('profile-image');
        }

        $addressData = [
            'type' => 'main',
            'address' => $data['address'],
            'province_id' => $data['province_id'],
            'city_id' => $data['city_id'],
        ];

        $address = $candidate->address()->updateOrCreate(
            [
                'candidate_id' => $candidate->id
            ],
            $addressData
        );

        $user = $candidate->user;
        $userData = ['name' => $data['name']];
        $this->userRepo->update($userData, $user->id);

        $this->repo->update($data, $candidate->id);

        $success['data'] = $candidate->refresh();

        CandidateProfileCompleteness::updateOrCreate(['activity' => 'profile_completeness', 'candidate_id' => $candidate->id], ['activity' => 'profile_completeness', 'label' => 'Complete Basic Info', 'candidate_id' => $candidate->id, 'is_complete' => true]);

        return $this->successResponse($success, __('content.message.update.success'), 201);
    }
    // ============================================================================== END UPDATE ABOUT ME ==============================================================================


    // ============================================================================== START UPDATE EDUCATION ==============================================================================
    public function updateEducation(Request $request)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            return $this->processUpdateEducation($candidate, $request);

        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function processUpdateEducation($candidate, $request)
    {
        $data = $request->all();

        if (isset($data['graduation_date'])) {
            $explodeEnd = explode("-", $data['graduation_date']);
            $data['month_graduation'] = $explodeEnd[1];
            $data['year_graduation'] = $explodeEnd[0];
        }

        if ($data['is_till_current']) {
            $data['year_graduation'] = null;
            $data['month_graduation'] = null;
        }

        $candidate->educations()->updateOrCreate([
            'id' => $data['id'] ?? null,
        ], ($data['id'] != null ? $data : Arr::except($data, ['id'])));

        $success['data'] = $candidate->educations()->get();

        CandidateProfileCompleteness::updateOrCreate(['activity' => 'education', 'candidate_id' => $candidate->id], ['activity' => 'education', 'label' => 'Add Education', 'candidate_id' => $candidate->id, 'is_complete' => true]);

        return $this->successResponse($success, __('content.message.update.success'), 201);
    }
    // ============================================================================== END UPDATE EDUCATION ==============================================================================

    // ============================================================================== START UPDATE WORK EXPERIENCE ==============================================================================
    public function updateWorkExperience(Request $request)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            return $this->processUpdateWorkExperience($candidate, $request);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function processUpdateWorkExperience($candidate, $request)
    {
        $data = $request->all();

        $explodeStart = explode("-", $data['start_of_work']);
        $data['start_of_month'] = $explodeStart[1];
        $data['start_of_year'] = $explodeStart[0];

        if (isset($data['end_of_work'])) {
            $explodeEnd = explode("-", $data['end_of_work']);
            $data['end_of_month'] = $explodeEnd[1];
            $data['end_of_year'] = $explodeEnd[0];
        }

        if ($data['is_till_current']) {
            $data['end_of_month'] = null;
            $data['end_of_year'] = null;
        }

        $candidate->work_experiences()->updateOrCreate([
            'id' => $data['id'] ?? null,
        ], ($data['id'] != null ? $data : Arr::except($data, ['id'])));

        $success['data'] = $candidate->work_experiences()->get();

        CandidateProfileCompleteness::updateOrCreate(['activity' => 'work_experience', 'candidate_id' => $candidate->id], ['activity' => 'work_experience', 'label' => 'Add Work Experience', 'candidate_id' => $candidate->id, 'is_complete' => true]);

        return $this->successResponse($success, __('content.message.update.success'), 201);
    }
    // ============================================================================== END UPDATE WORK EXPERIENCE ==============================================================================


    // ============================================================================== START UPDATE SKILL ==============================================================================
    public function updateSkill(Request $request)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            return $this->processUpdateSkill($candidate, $request);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function processUpdateSkill($candidate, $request)
    {
        $data = $request->all();

        $skillLabel = ucwords($data['skill']);
        $skill = $this->skillRepo->findWhere(['label' => $skillLabel]);
        if (!$skill) {
            $skill = $this->skillRepo->create(['label' => $skillLabel]);
        }

        $data['skill'] = $skillLabel;

        $candidate->skills()->updateOrCreate([
            'id' => $data['id'] ?? null,
        ], ($data['id'] != null ? $data : Arr::except($data, ['id'])));

        $success['data'] = $candidate->skills()->get();

        CandidateProfileCompleteness::updateOrCreate(['activity' => 'skill', 'candidate_id' => $candidate->id], ['activity' => 'skill', 'label' => 'Add Skill', 'candidate_id' => $candidate->id, 'is_complete' => true]);

        return $this->successResponse($success, __('content.message.update.success'), 201);
    }
    // ============================================================================== END UPDATE SKILL ==============================================================================
    
    // ============================================================================== START UPDATE RESUME ==============================================================================
    public function updateResume(Request $request)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;
            
            return $this->processUpdateResume($candidate, $request);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }
    
    public function processUpdateResume($candidate, $request)
    {
        $path = $request->file('resume')->store('candidate-resumes');

        $data = [];
        $data['filename'] = $path;
        $data['is_active'] = true;

        $candidate->resumes()->create($data);

        $success['data'] = $candidate->resumes()->get();

        return $this->successResponse($success, __('content.message.update.success'), 201);
    }
    // ============================================================================== END UPDATE RESUME ==============================================================================

    public function deleteUpdateEducation($request, $id)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $candidate->educations()->where('id', $id)->delete();

            $success['data'] = $candidate->educations()->get();

            return $this->successResponse($success, __('content.message.delete.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function deleteUpdateWorkExperience($request, $id)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $candidate->work_experiences()->where('id', $id)->delete();

            $success['data'] = $candidate->work_experiences()->get();

            return $this->successResponse($success, __('content.message.delete.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function deleteUpdateSkill($request, $id)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $candidate->skills()->where('id', $id)->delete();

            $success['data'] = $candidate->skills()->get();

            return $this->successResponse($success, __('content.message.delete.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function deleteUpdateResumes($request, $id)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $candidate->resumes()->where('id', $id)->delete();

            $success['data'] = $candidate->resumes()->get();

            return $this->successResponse($success, __('content.message.delete.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }
}
