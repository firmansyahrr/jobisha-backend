<?php

namespace App\Services\General;

use App\Filters\General\ContactUsFilter;
use App\Repositories\General\ContactUsRepository;
use App\Services\BaseService;

class ContactUsService extends BaseService
{
    public function __construct(ContactUsRepository $repo, ContactUsFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Contact Us';
        $this->filterClass = $filter;
    }
}
