<?php

namespace App\Repositories\Company;

use App\Models\Companies\Company;
use App\Repositories\BaseRepository;

class CompanyRepository extends BaseRepository
{
    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
