<?php

namespace App\Http\Controllers;

use App\Models\Candidate\Candidate;
use App\Models\Companies\Company;
use App\Models\Job\Job;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $candidateRegistered = Candidate::count();
        $jobRegistered = Job::count();
        $companyRegistered = Company::count();
        return view('home', [
            'registered_candidate' => $candidateRegistered,
            'registered_job' => $jobRegistered,
            'registered_company' => $companyRegistered
        ]);
    }
}
