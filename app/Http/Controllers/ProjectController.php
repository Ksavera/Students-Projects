<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $student = auth()->user();
        return view('projects.index', compact('projects', 'student'));
    }
    public function create(User $student)
    {
        return view('projects.create', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request, User $student)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $student->id;

        if ($request->hasFile('project_photo')) {
            $photoPath = $request->file('project_photo')->store('projects', 'public');

            $validatedData['project_photo'] = $photoPath;
        }

        $project = Project::create($validatedData);

        $successMessage = 'Congratulations, ' . $student->name . '! Your project was added';

        return redirect()
            ->route('dashboard', ['student' => $student, 'project' => $project->id])
            ->with('success', $successMessage);
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project, User $student)
    {

        return view('projects.show', compact('project', 'student'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $student, $id)
    {
        $project = Project::findOrFail($id);
        return view('projects.create', compact('student', 'project'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('project_photo')) {
            $photoPath = $request->file('project_photo')->store('projects', 'public');
            $validatedData['project_photo'] = $photoPath;
        }



        // Assuming you have a project instance available, you can update it like this:
        $project->fill($validatedData);
        $project->save();

        // Assuming you have a $student variable available, you can retrieve the student from the project
        $student = $project->user;

        $successMessage = 'Congratulations, ' . $student->name . '! Your project was updated';

        return redirect()
            ->route('projects.show', compact('project', 'student'))
            ->with('success', $successMessage);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student, Project $project)
    {
        // Find the project by its ID and make sure it belongs to the specified student

        if (!$project) {
            return redirect()->route('dashboard')->with('error', 'Project not found or does not belong to the student.');
        }
        if ($project->project_photo) {
            Storage::disk('public')->delete($project->project_photo);
        }
        // Delete the project
        $project->delete();

        // Construct the success message
        $successMessage = 'Congratulations, ' . $student->name . '! Your project was deleted';

        // Redirect back to the dashboard with the success message
        return redirect()->route('dashboard')
            ->with('success', $successMessage);
    }
}
