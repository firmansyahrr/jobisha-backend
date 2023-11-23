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

class CandidateEducation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, AddCreatedUser, SoftDeleteWithUser, InteractsWithMedia;

    protected $table = 'candidate_educations';

    protected $guarded = ['id'];

    protected $hidden = ['major', 'year_from', 'year_to', 'month_graduation', 'year_graduation'];
    
    protected $appends = ['graduation_date'];

    public function getGraduationDateAttribute()
    {
        if (!$this->is_till_current) {
            return $this->year_graduation . '-' . $this->month_graduation;
        }

        return null;
    }
}
