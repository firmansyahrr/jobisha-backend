<?php

namespace App\Models\Candidate;

use App\Traits\AddCreatedUser;
use App\Traits\SoftDeleteWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
