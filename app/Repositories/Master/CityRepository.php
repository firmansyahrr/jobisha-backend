<?php

namespace App\Repositories\Master;

use App\Models\Master\City;
use App\Repositories\BaseRepository;

class CityRepository extends BaseRepository
{
    public function __construct(City $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
