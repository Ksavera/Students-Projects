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
Route::get('students', [StudentController::class, 'index'])->name('students.index');
Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('students/{student}', [StudentController::class, 'show'])->name('students.show');



// Routes accessible to authentificated users
Route::group(['middleware' => 'auth'], function () {
    Route::get('/account', [UserController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [UserController::class, 'update'])->name('account.update');
    Route::delete('/account', [UserController::class, 'destroy'])->name('account.destroy');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('profiles', ProfileController::class);
    Route::resource('profiles.projects', ProjectController::class)->shallow()->names('projects')->except('index');
});

require __DIR__ . '/auth.php';
