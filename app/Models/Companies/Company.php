<?php

namespace App\Models\Companies;

use App\Models\Master\ApplicationParameter;
use App\Models\Master\City;
use App\Models\Master\Province;
use App\Traits\AddCreatedUser;
use App\Traits\SoftDeleteWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class Company extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, AddCreatedUser, SoftDeleteWithUser;

    protected $guarded = ['id', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($company) {
            $company->slug = $company->createSlug($company);
            $company->save();
        });
    }

    private function createSlug($company)
    {
        $name = $company->name;
        $slugCombination = $name;
        if (static::whereSlug($slug = Str::slug($slugCombination))->exists()) {
            $max = static::where('name', $name)->get()->count();

            return $slug . "-" . ($max + 1);
        }

        return $slug;
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function employe_size(){
        return $this->belongsTo(ApplicationParameter::class, 'employee_size_id', 'id');
    }

    public function company_industry(){
        return $this->belongsTo(ApplicationParameter::class, 'company_industry_id', 'id');
    }
}
