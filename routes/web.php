<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes accessible to all users
Route::resource('profiles', ProfileController::class)->only('index', 'show');
Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');




// Routes accessible to authentificated users
Route::group(['middleware' => 'auth'], function () {
    Route::get('/account', [UserController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [UserController::class, 'update'])->name('account.update');
    Route::delete('/account', [UserController::class, 'destroy'])->name('account.destroy');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('profiles', ProfileController::class)->except('index');
    Route::resource('profiles.projects', ProjectController::class)->shallow()->names('projects')->except('index');
});

require __DIR__ . '/auth.php';
