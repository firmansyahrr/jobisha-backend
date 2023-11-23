<?php

namespace App\Models\Candidate;

use App\Models\Job\JobRole;
use App\Models\Job\JobSpecialization;
use App\Models\Master\ApplicationParameter;
use App\Traits\AddCreatedUser;
use App\Traits\SoftDeleteWithUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CandidateWorkExperience extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, AddCreatedUser, SoftDeleteWithUser, InteractsWithMedia;

    protected $table = 'candidate_work_experiences';

    protected $guarded = ['id'];

    protected $hidden = ['start_of_month', 'start_of_year', 'end_of_month', 'end_of_year'];

    protected $appends = ['start_of_work', 'end_of_work'];
    
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'ASC');
        });
    }

    public function getStartOfWorkAttribute()
    {
        return $this->start_of_year . '-' . $this->start_of_month;
    }

    public function getEndOfWorkAttribute()
    {
        if (!$this->is_till_current) {
            return $this->end_of_year . '-' . $this->end_of_month;
        }

        return null;
    }

    public function salary_range(): BelongsTo
    {
        return $this->belongsTo(ApplicationParameter::class, 'salary_range_id', 'id');
    }

    public function career_level(): BelongsTo
    {
        return $this->belongsTo(ApplicationParameter::class, 'career_level_id', 'id');
    }

    public function job_specialization(): BelongsTo
    {
        return $this->belongsTo(JobSpecialization::class);
    }

    public function job_role(): BelongsTo
    {
        return $this->belongsTo(JobRole::class);
    }
}
