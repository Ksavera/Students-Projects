<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Profile::all();
        return view('profiles.index', compact('students'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Profile $student)
    {
        $student->increment('views');
        return view('profiles.show', compact('student'));
    }
}
