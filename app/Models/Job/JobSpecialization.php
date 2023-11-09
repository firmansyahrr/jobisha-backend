<?php

namespace App\Models\Job;

use App\Traits\AddCreatedUser;
use App\Traits\SoftDeleteWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class JobSpecialization extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, AddCreatedUser, SoftDeleteWithUser;

    protected $fillable = [
        'code',
        'label',
    ];
}
