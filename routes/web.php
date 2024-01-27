<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Job\JobController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'loginWeb'])->name('auth.login.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::prefix('candidate')->group(function () {
        Route::post('/', [CandidateController::class, 'store'])->name('candidate.store');
        
        Route::post('/del/{id}', [CandidateController::class, 'deleteWeb'])->name('candidate.delete');

        Route::post('/{id}/education', [CandidateController::class, 'updateEducationWeb'])->name('candidate.update.education');
        Route::post('/{id}/work-experience', [CandidateController::class, 'updateWorkExperienceWeb'])->name('candidate.update.work-experience');
        Route::post('/{id}/skill', [CandidateController::class, 'updateSkilleWeb'])->name('candidate.update.skill');
        Route::post('/{id}/resume', [CandidateController::class, 'updateResumeWeb'])->name('candidate.update.resume');

        Route::get('/', [CandidateController::class, 'indexWeb'])->name('candidate.index');
        Route::get('/create', [CandidateController::class, 'createWeb'])->name('candidate.create');
        Route::get('/{id}', [CandidateController::class, 'detailWeb'])->name('candidate.detail');
    });
    
    Route::prefix('job')->group(function () {
        Route::post('/', [JobController::class, 'postCreateJobWeb'])->name('job.store');

        Route::post('/del/{id}', [JobController::class, 'deleteWeb'])->name('job.delete');

        Route::get('/', [JobController::class, 'indexWeb'])->name('job.index');
        Route::get('/create', [JobController::class, 'createWeb'])->name('job.create');
        Route::get('/{id}', [JobController::class, 'detailWeb'])->name('job.detail');
    });

});

Route::prefix('email')->group(function () {
    Route::get('/verify/{id}/{hash}', [EmailVerifyController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});