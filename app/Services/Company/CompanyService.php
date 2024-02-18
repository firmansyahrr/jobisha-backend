<?php

namespace App\Services\Company;

use App\Filters\Company\CompanyFilter;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Log;

class CompanyService extends BaseService
{
    protected $userRepo;

    public function __construct(CompanyRepository $repo, CompanyFilter $filter, UserRepository $userRepo)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->object = 'Company';
        $this->filterClass = $filter;
        $this->indexWith = [
            'province',
            'city',
            'employee_size',
            'company_industry',
        ];

        $this->detailWith = [
            'province',
            'city',
            'employee_size',
            'company_industry',
        ];

        $this->userRepo = $userRepo;
    }

    public function getBySlug($slug)
    {
        $data = $this->repo->with($this->detailWith)->get(['slug' => $slug])->first();
        $success['data'] = [];
        if (isset($data)) {
            $success['data'] = $data;
        }

        return $this->successResponse($success, __('content.message.default.success'));
    }

    public function register($data)
    {
        DB::beginTransaction();
        try {

            $company = $this->repo->create(
                [
                    'name' => $data['company_name'],
                    'address' => $data['company_address'],
                    'email' => $data['company_email'],
                ]
            );

            // Insert into user
            $userData = Arr::only($data, ['name', 'email']);
            $userData['password'] = bcrypt($data['password']);
            $userData['company_id'] = $company->id;

            $user = $this->userRepo->create($userData);
            $user->assignRole('company-admin');

            DB::commit();
            event(new Registered($user));

            $success['data'] = $user->refresh();

            return $this->successResponse($success, __('content.message.default.success'));
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc->getMessage());
            $this->failedResponse([], $exc->getMessage());
            
            return $this->failedResponse([], $exc->getMessage());
        }
    }
}
