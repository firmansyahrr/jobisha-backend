<?php

namespace App\Repositories\Master;

use App\Models\Master\Province;
use App\Repositories\BaseRepository;

class ProvinceRepository extends BaseRepository
{
    public function __construct(Province $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
