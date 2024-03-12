<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $projects = Project::all();
        return view("projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Student $student)
    {
        return view('projects.create', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|between:3,255',
            'photo' => 'required|file|mimes:jpg,png,jpeg|max:20000',
            'description' => 'required|string|between:3,600',
            'github' => 'required|string|between:3,600'
        ]);
        $file = $request->file('photo');
        $path = $file->store('project_photos', 'public');
        $project = Project::create([
            'name' => $validatedData['name'],
            'photo' => $path,
            'description' => $validatedData['description'],
            'github' => $validatedData['github'],
            'student_id' => $student->id,
        ]);

        $successMessage = 'Congratulations, ' . $student->name . '! Your project was added';

        return redirect()
            ->route('projects.show', ['student' => $student, 'project' => $project->id])
            ->with('success', $successMessage)
            ->withInput();;
    }


    /**
     * Display the specified resource.
     */
    public function show(Student $student, Project $project)
    {
        return view('projects.show', compact('student', 'project'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
