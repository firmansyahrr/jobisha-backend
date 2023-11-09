<?php

namespace App\Repositories\General;

use App\Models\General\Testimony;
use App\Repositories\BaseRepository;

class TestimonyRepository extends BaseRepository
{
    public function __construct(Testimony $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
