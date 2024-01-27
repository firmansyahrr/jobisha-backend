<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\RegisterEmployerRequest;
use App\Models\Companies\Company;
use App\Services\Company\CompanyService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CompanyController extends Controller
{
    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }

        // ========================================================================= WEB
        public function indexWeb(Request $request)
        {
            $breadcrumbsItems = [
                [
                    'name' => 'Company',
                    'url' => route('company.index'),
                    'active' => true
                ],
            ];
    
            $q = $request->get('q');
            $perPage = $request->get('per_page', 10);
            $sort = $request->get('sort');
    
            $datas = QueryBuilder::for(Company::class)
                ->allowedSorts(['name'])
                ->latest()
                ->paginate($perPage)
                ->appends(['per_page' => $perPage, 'q' => $q, 'sort' => $sort]);
    
            return view('pages.company.index', [
                'companies' => $datas,
                'breadcrumbItems' => $breadcrumbsItems,
                'pageTitle' => 'Job'
            ]);
        }
        // ========================================================================= WEB

    public function index(Request $request)
    {
        
        return $this->service->all($request->all());
    }

    public function getBySlug(Request $request, $slug)
    {
        
        return $this->service->getBySlug($slug);
    }

    public function register(RegisterEmployerRequest $request)
    {
        return $this->service->register($request);
    }
}
