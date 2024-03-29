<?php

use App\Http\Controllers\Api\General\ContactUsController;
use App\Http\Controllers\Api\General\TestimonyController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\Job\JobController;
use App\Http\Controllers\Job\JobRoleController;
use App\Http\Controllers\Job\JobSpecializationController;
use App\Http\Controllers\JobBoard\JobBoardController;
use App\Http\Controllers\Landing\LandingPageController;
use App\Http\Controllers\Master\ApplicationParameterController;
use App\Http\Controllers\Master\CityController;
use App\Http\Controllers\Master\ProvinceController;
use App\Http\Controllers\Master\SkillController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Register Candidate
Route::prefix('register')->group(function () {
    Route::post('/candidates', [CandidateController::class, 'register']);
    Route::post('/employer', [CompanyController::class, 'register']);
});


Route::post('/login', [AuthenticationController::class, 'login']);

// Resend link to verify email
Route::post('/email/verify/resend', [EmailVerifyController::class, 'resend'])->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user-profile', [CandidateController::class, 'userProfile']);
    Route::prefix('profile')->group(function () {
        Route::get('/', [CandidateController::class, 'profile']);
        Route::post('/about-me', [CandidateController::class, 'postUpdateAboutMe']);

        Route::post('/educations', [CandidateController::class, 'postUpdateEducation']);
        Route::delete('/educations/{id}', [CandidateController::class, 'deleteUpdateEducation']);

        Route::post('/work-experiences', [CandidateController::class, 'postUpdateWorkExperience']);
        Route::delete('/work-experiences/{id}', [CandidateController::class, 'deleteUpdateWorkExperience']);

        Route::post('/skills', [CandidateController::class, 'postUpdateSkill']);
        Route::delete('/skills/{id}', [CandidateController::class, 'deleteUpdateSkill']);

        Route::post('/resumes', [CandidateController::class, 'postUpdateResumes']);
        Route::delete('/resumes/{id}', [CandidateController::class, 'deleteUpdateResumes']);
        
        Route::get('/job-saved', [CandidateController::class,'getJobSaved']);
        Route::get('/job-applied', [CandidateController::class,'getJobHistory']);
    });

    Route::prefix('jobs')->group(function () {
        Route::post('/', [JobController::class, 'postCreateJob'])->middleware(['can:create_job']);
        Route::post('/{slug}/save', [CandidateController::class, 'postSaveJob']);
        Route::post('/{slug}/unsave', [CandidateController::class, 'postUnSaveJob']);
        Route::post('/{slug}/apply', [CandidateController::class, 'postApplyJob']);
    });

    Route::prefix('candidates')->group(function () {
        Route::post('/', [CandidateController::class, 'store'])->middleware(['create_candidate']);
        Route::post('/{id}', [CandidateController::class, 'update'])->middleware(['update_candidate']);
    });
});

Route::middleware(['custom_api'])->group(function () {

    Route::prefix('master')->group(function () {
        Route::get('/job-specializations', [JobSpecializationController::class, 'index']);
        Route::get('/job-roles', [JobRoleController::class, 'index']);
        Route::get('/skills', [SkillController::class, 'index']);
        Route::get('/career-levels', [ApplicationParameterController::class, 'index']);
        Route::get('/company-industries', [ApplicationParameterController::class, 'index']);
        Route::get('/employee-sizes', [ApplicationParameterController::class, 'index']);
        Route::get('/job-types', [ApplicationParameterController::class, 'index']);
        Route::get('/work-preferences', [ApplicationParameterController::class, 'index']);
        Route::get('/salary-ranges', [ApplicationParameterController::class, 'index']);
        Route::get('/skill-levels', [ApplicationParameterController::class, 'index']);
        Route::get('/education-levels', [ApplicationParameterController::class, 'index']);
        Route::get('/genders', [ApplicationParameterController::class, 'index']);
        Route::get('/provinces', [ProvinceController::class, 'index']);
        Route::get('/provinces/{id}/cities', [CityController::class, 'index']);
    });

    Route::post('/contact-us', [ContactUsController::class, 'create']);

    Route::prefix('landing')->group(function () {
        Route::get('/testimonies', [LandingPageController::class, 'getTestimony']);
        Route::get('/counters', [LandingPageController::class, 'getCounter']);
        Route::get('/popular-jobs', [LandingPageController::class, 'getPopularJob']);
        Route::get('/match-jobs', [LandingPageController::class, 'getPopularJob']);
    });

    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobController::class, 'index']);
        Route::get('/{slug}', [JobController::class, 'getBySlug']);
    });

    Route::prefix('companies')->group(function () {
        Route::get('/', [CompanyController::class, 'index']);
        Route::get('/{slug}', [CompanyController::class, 'getBySlug']);
        Route::get('/{slug}/jobs', [JobController::class, 'getByCompany']);
    });
});