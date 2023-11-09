<?php

namespace App\Services\Candidate;

use App\Filters\Candidate\CandidateFilter;
use App\Repositories\Candidate\CandidateRepository;
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
    public function __construct(CandidateRepository $repo, CandidateFilter $filter, UserRepository $userRepo)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Candidate';
        $this->filterClass = $filter;

        $this->userRepo = $userRepo;
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

            $this->repo->update(['about_me' => $request->about_me], $candidate->id);

            $success['data'] = [$candidate->refresh()];

            return $this->successResponse($success, __('content.message.update.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc->getMessage());
            return $this->failedResponse(null, $exc->getMessage());
        }
    }
}
