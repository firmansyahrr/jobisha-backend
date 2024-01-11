<?php

namespace App\Repositories\General;

use App\Models\General\ContactUs;
use App\Repositories\BaseRepository;

class ContactUsRepository extends BaseRepository
{
    public function __construct(ContactUs $model)
    {
        $this->model = $model;
    }

    /*
    * Create your custom function here
    * ...
    **/
}
