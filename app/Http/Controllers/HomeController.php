<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(User $student)
    {
        $students = Profile::orderBy('views', 'desc')->take(5)->get();
        return view('home', compact('students'));
    }
}
