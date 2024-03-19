<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes accessible to all users
Route::get('students', [UserController::class, 'index'])->name('students.index');
Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('students/{student}', [UserController::class, 'show'])->name('students.show');



// Routes accessible to authentificated users
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('students.projects', ProjectController::class)->shallow()->names('projects')->except('index');
});

require __DIR__ . '/auth.php';
