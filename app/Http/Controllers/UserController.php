<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $students = User::all();
        return view('students.index', compact('students'));
    }
    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        $student->increment('views');
        return view('students.show', compact('student'));
    }
}
