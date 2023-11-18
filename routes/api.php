<?php

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
});


Route::post('/login', [AuthenticationController::class, 'login']);

// Resend link to verify email
Route::post('/email/verify/resend', [EmailVerifyController::class, 'resend'])->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [CandidateController::class, 'profile']);
        Route::post('/about-me', [CandidateController::class, 'postUpdateAboutMe']);
        Route::post('/educations', [CandidateController::class, 'postUpdateEducation']);
        Route::post('/work-experiences', [CandidateController::class, 'postUpdateWorkExperience']);
        Route::post('/skills', [CandidateController::class, 'postUpdateSkill']);
        Route::post('/resumes', [CandidateController::class, 'postUpdateResumes']);
    });

    Route::prefix('jobs')->group(function () {
        Route::post('/{slug}/save', [CandidateController::class, 'postSaveJob']);
        Route::post('/{slug}/apply', [CandidateController::class, 'postApplyJob']);
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
    });

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