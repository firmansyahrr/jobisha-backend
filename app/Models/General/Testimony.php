<?php

namespace App\Models\General;

use App\Traits\AddCreatedUser;
use App\Traits\SoftDeleteWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Testimony extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, AddCreatedUser, SoftDeleteWithUser;

    protected $table = "testimonies";

    protected $fillable = [
        'name',
        'photos',
        'position',
        'company',
        'testimoni',
        'rating'
    ];
}