<?php

namespace App\Models\Job;

use App\Models\Candidate\CandidateJob;
use App\Models\Companies\Company;
use App\Models\Master\ApplicationParameter;
use App\Models\Master\City;
use App\Traits\AddCreatedUser;
use App\Traits\SoftDeleteWithUser;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class Job extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, AddCreatedUser, SoftDeleteWithUser;

    protected $guarded = ['id', 'slug'];

    protected $appends = ['is_saved', 'is_applied'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($job) {
            $job->slug = $job->createSlug($job);
            $job->save();
        });
    }

    private function createSlug($job)
    {
        $company = $job->company()->first();
        $jobSpecialization = $job->job_specialization()->first();
        $jobRole = $job->job_role()->first();
        $title = $job->title;
        $slugCombination = $company->name . " " . $title . " " . $jobSpecialization->label . " " . $jobRole->label;
        if (static::whereSlug($slug = Str::slug($slugCombination))->exists()) {
            $max = static::where('title', $title)
                ->where('company_id', $company->id)
                ->where('job_role_id', $jobRole->id)
                ->where('job_specialization_id', $jobSpecialization->id)
                ->latest('id')->get()->count();

            return $slug . "-" . ($max + 1);
        }

        return $slug;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function job_type()
    {
        return $this->belongsTo(ApplicationParameter::class, 'job_type_id', 'id');
    }

    public function career_level()
    {
        return $this->belongsTo(ApplicationParameter::class, 'career_level_id', 'id');
    }

    public function job_role()
    {
        return $this->belongsTo(JobRole::class);
    }

    public function job_specialization()
    {
        return $this->belongsTo(JobSpecialization::class);
    }

    public function job_preferences()
    {
        return $this->hasManyThrough(ApplicationParameter::class, JobPreference::class, 'job_id', 'id', 'id', 'preference_id');
    }

    public function job_locations()
    {
        return $this->hasManyThrough(City::class, JobLocation::class, 'job_id', 'id', 'id', 'city_id');
    }

    public function getIsSavedAttribute()
    {
        $isSaved = false;
        $authCheck = auth('sanctum')->check();

        if ($authCheck) {
            $user = auth('sanctum')->user();
            $candidateId = $user->candidate_id;

            if ($candidateId != null) {
                $count = CandidateJob::where('candidate_id', $candidateId)->where('job_id', $this->id)->where('type', 'saved')->count();
                if ($count > 0) {
                    $isSaved = true;
                }
            }
        }

        return $isSaved;
    }

    public function getIsAppliedAttribute()
    {
        $isApplied = false;
        $authCheck = auth('sanctum')->check();

        if ($authCheck) {
            $user = auth('sanctum')->user();
            $candidateId = $user->candidate_id;

            if ($candidateId != null) {
                $count = CandidateJob::where('candidate_id', $candidateId)->where('job_id', $this->id)->where('type', 'applied')->count();
                if ($count > 0) {
                    $isApplied = true;
                }
            }
        }

        return $isApplied;
    }
}
