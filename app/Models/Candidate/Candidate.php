<?php

namespace App\Models\Candidate;

use App\Models\Master\ApplicationParameter;
use App\Traits\AddCreatedUser;
use App\Traits\SoftDeleteWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Candidate extends Model implements Auditable, HasMedia
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, AddCreatedUser, SoftDeleteWithUser, InteractsWithMedia;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($obj) {
            $obj->slug = Str::uuid();
            $obj->save();
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(CandidateAddress::class);
    }

    public function educations(): HasMany
    {
        return $this->hasMany(CandidateEducation::class);
    }

    public function job(): HasMany
    {
        return $this->hasMany(CandidateJob::class);
    }

    public function work_experiences(): HasMany
    {
        return $this->hasMany(CandidateWorkExperience::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(CandidateSkill::class);
    }

    public function resumes(): HasMany
    {
        return $this->hasMany(CandidateResume::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(ApplicationParameter::class, 'gender_id', 'id');
    }
}
