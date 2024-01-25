<?php

use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\EmailVerifyController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login.main');
})->name('auth.login');

Route::prefix('candidate')->group(function () {
    Route::post('/', [CandidateController::class, 'store'])->name('candidate.store');

    Route::post('/{id}/education', [CandidateController::class, 'updateEducationWeb'])->name('candidate.update.education');

    Route::get('/', [CandidateController::class, 'indexWeb'])->name('candidate.index');
    Route::get('/create', [CandidateController::class, 'createWeb'])->name('candidate.create');
    Route::get('/{id}', [CandidateController::class, 'detailWeb'])->name('candidate.detail');
});

Route::prefix('email')->group(function () {
    Route::get('/verify/{id}/{hash}', [EmailVerifyController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});