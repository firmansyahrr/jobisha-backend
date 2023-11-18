<?php

namespace App\Services\Candidate;

use App\Filters\Candidate\CandidateFilter;
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

    public function profile(Request $request)
    {
        try {
            $user = $this->userRepo->with(['candidate.addresses', 'candidate.educations'])->find($request->user()->id);
            $success['data'] = [$user];

            return $this->successResponse($success, __('content.message.read.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function register(Request $request)
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

            DB::commit();
            event(new Registered($user));
            $success['data'] = $candidate;

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

            $success['data'] = [$candidate->refresh()];

            return $this->successResponse($success, __('content.message.job.save.success'), 200);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse([], __('content.message.job.save.failed') . ': ' . $exc->getMessage());
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

            $success['data'] = [$candidate->refresh()];

            return $this->successResponse($success, __('content.message.job.apply.success'), 200);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse([], __('content.message.job.apply.failed') . ': ' . $exc->getMessage());
        }
    }

    public function updateAboutMe(Request $request)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $this->repo->update(['about_me' => $request->about_me], $candidate->id);

            $success['data'] = [$candidate->refresh()];

            return $this->successResponse($success, __('content.message.update.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function updateEducation(Request $request)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $educations = collect($request->educations);
            $educations->each(function ($data) use ($candidate) {
                $candidate->educations()->updateOrCreate([
                    'id' => $data['id'] ?? null,
                ], ($data['id'] != null ? $data : Arr::except($data, ['id'])));
            });

            $success['data'] = [$candidate->refresh()];

            return $this->successResponse($success, __('content.message.update.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function updateWorkExperience(Request $request)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $workExperiences = collect($request->work_experiences);
            $workExperiences->each(function ($data) use ($candidate) {
                $candidate->work_experiences()->updateOrCreate([
                    'id' => $data['id'] ?? null,
                ], ($data['id'] != null ? $data : Arr::except($data, ['id'])));
            });

            $success['data'] = [$candidate->refresh()];

            return $this->successResponse($success, __('content.message.update.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }

    public function updateSkill(Request $request)
    {
        try {
            $user = $this->userRepo->find($request->user()->id);
            $candidate = $user->candidate;

            $skills = collect($request->skills);
            $skills->each(function ($data) use ($candidate) {

                $skillLabel = ucwords($data['skill']);
                $skill = $this->skillRepo->findWhere(['label' => $skillLabel]);
                if (!$skill) {
                    $skill = $this->skillRepo->create(['label' => $skillLabel]);
                }

                $data['skill'] = $skillLabel;

                $candidate->candidate_skills()->updateOrCreate([
                    'id' => $data['id'] ?? null,
                ], ($data['id'] != null ? $data : Arr::except($data, ['id'])));
            });

            $success['data'] = [$candidate->refresh()];

            return $this->successResponse($success, __('content.message.update.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }
}
