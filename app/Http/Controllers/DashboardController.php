<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()

    {
        $profile = auth()->user()->profile;
        if (isset($profile)) {
            $projects = $profile->projects;
        } else {
            $projects = null;
        }


        return view('dashboard', compact('projects', 'profile'));
    }
}
