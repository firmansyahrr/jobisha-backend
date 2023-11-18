<?php

namespace App\Services\Master;

use App\Filters\Master\ApplicationParameterFilter;
use App\Filters\Master\SkillFilter;
use App\Repositories\Master\ApplicationParameterRepository;
use App\Repositories\Master\SkillRepository;
use App\Services\BaseService;

class ApplicationParameterService extends BaseService
{
    public function __construct(ApplicationParameterRepository $repo, ApplicationParameterFilter $filter)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Application Parameter';
        $this->filterClass = $filter;
    }

    public function allByType($request, $segment)
    {
        try {
            $request['type'] = str_replace('-','_', $segment);

            $datas = $this->repo->all($request, $this->filterClass);
            $success = $datas;

            return $this->successResponse($success, __('content.message.default.success'));
        } catch (\Throwable $th) {
            return $this->failedResponse([], __('message.server_error'), $th->getCode());
        }
    }
}
