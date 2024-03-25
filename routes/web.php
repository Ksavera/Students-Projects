<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Routes accessible to all users
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profiles/{profile}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/profiles/{profile}/projects/{project}', [ProjectController::class, 'showProfileProject'])->name('profiles.projects.show');

// Routes accessible to authentificated users
Route::group(['middleware' => 'auth'], function () {

    //Account
    Route::get('/account', [UserController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [UserController::class, 'update'])->name('account.update');
    Route::delete('/account', [UserController::class, 'destroy'])->name('account.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/profiles', ProfileController::class)->except('index', 'show');

    Route::resource('dashboard/projects', ProjectController::class)->except('index', 'show');
});

require __DIR__ . '/auth.php';
