<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Profile;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {

        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request)
    {
        $validatedData = $request->validated();

        $profile = auth()->user()->profile;

        $validatedData['profile_id'] = $profile->id;

        if ($request->hasFile('project_photo')) {
            $photoPath = $request->file('project_photo')->store('projects', 'public');
            $validatedData['project_photo'] = $photoPath;
        }

        $project = Project::create($validatedData);

        $successMessage = 'Congratulations! ' . $profile->user->name . ' Your project was added';

        return redirect()
            ->route('dashboard', compact('profile', 'project'))
            ->with('success', $successMessage);
    }





    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        return view('projects.show', compact('project'));
    }

    public function showProfileProject(Profile $profile, Project $project)
    {
        return view('projects.show', compact('profile', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        return view('projects.create', compact('project'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->fill($request->validated());

        if ($request->hasFile('project_photo')) {
            $photoPath = $request->file('project_photo')->store('projects', 'public');
            $validatedData['project_photo'] = $photoPath;
        }


        $project->save();


        $profile = $project->profile()->with('user')->firstOrFail();

        $successMessage = 'Congratulations, ' . $profile->user->name . '! Your project was updated';

        return redirect()
            ->route('projects.show', compact('project'))
            ->with('success', $successMessage);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Project $project)
    {
        $user = Auth::user();

        if (!$project) {
            return redirect()->route('dashboard')->with('error', 'Project not found or does not belong to the user.');
        }
        if ($project->project_photo) {
            Storage::disk('public')->delete($project->project_photo);
        }
        // Delete the project
        $project->delete();

        // Construct the success message
        $successMessage = 'Congratulations, ' . $user->name . '! Your project was deleted';

        // Redirect back to the dashboard with the success message
        return redirect()->route('dashboard')
            ->with('success', $successMessage);
    }
}
