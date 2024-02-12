<?php

namespace App\Services\Job;

use App\Filters\Job\JobFilter;
use App\Models\Job\JobLocation;
use App\Models\Job\JobPreference;
use App\Models\Master\City;
use App\Repositories\Job\JobRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JobService extends BaseService
{
    public function __construct(JobRepository $repo, JobFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Job';
        $this->filterClass = $filter;
        $this->indexWith = [
            'company.company_industry',
            'job_type',
            'career_level',
            'job_role',
            'job_specialization',
            'job_preferences',
            'job_locations'
        ];

        $this->detailWith = [
            'company.company_industry',
            'job_type',
            'career_level',
            'job_role',
            'job_specialization',
            'job_preferences',
            'job_locations'
        ];
    }

    public function getBySlug($slug)
    {
        $data = $this->repo->with($this->detailWith)->get(['slug' => $slug])->first();
        $success['data'] = [];
        if (isset($data)) {
            $success['data'] = $data;
        }

        return $this->successResponse($success, __('content.message.default.success'));
    }


    public function create(array $data)
    {
        try {
            $execute = DB::transaction(function () use ($data) {
                $created = $this->repo->create($data);

                $preferences = $data['job_preferences'];
                foreach ($preferences as $key => $preference) {
                    $jobPref = JobPreference::updateOrCreate(['job_id' => $created->id, 'preference_id' => $preference], ['job_id' => $created->id, 'preference_id' => $preference]);
                }

                $cities = $data['job_locations'];
                foreach ($cities as $key => $ct) {
                    $city = City::where('id', $ct)->get()->first();
                    $jobLoc = JobLocation::updateOrCreate(['job_id' => $created->id, 'city_id' => $city->id], ['job_id' => $created->id, 'city_id' => $city->id, 'province_id' => $city->province_id]);
                }

                return $created->refresh();
            });

            $success['data'] = $execute;

            return $this->successResponse($success, __('content.message.create.success'), 201);
        } catch (Exception $exc) {
            Log::error($exc);
            return $this->failedResponse(null, __('content.message.create.failed'), 400);
        }
    }

    public function update(array $data, $id)
    {
        try {
            $execute = DB::transaction(function () use ($data, $id) {
                $updated = $this->repo->update($data, $id);

                $preferences = $data['job_preferences'];
                JobPreference::where('job_id', $updated->id)->delete();
                foreach ($preferences as $key => $preference) {
                    $jobPref = JobPreference::updateOrCreate(['job_id' => $updated->id, 'preference_id' => $preference], ['job_id' => $updated->id, 'preference_id' => $preference]);
                }

                $cities = $data['job_locations'];
                JobLocation::where('job_id', $updated->id)->delete();
                foreach ($cities as $key => $ct) {
                    $city = City::where('id', $ct)->get()->first();
                    $jobLoc = JobLocation::updateOrCreate(['job_id' => $updated->id, 'city_id' => $city->id], ['job_id' => $updated->id, 'city_id' => $city->id, 'province_id' => $city->province_id]);
                }

                return $updated;
            });

            $success['data'] = $execute;

            return $this->successResponse($success, __('content.message.update.success'));
        } catch (Exception $exc) {
            Log::error('Updating data from ' . get_class($this), $exc);

            return $this->failedResponse(null, __('content.message.create.failed'), 400);
        }
    }
}
