<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Profile;
use App\Models\User;
use App\Models\Project;
use App\View\Components\profiles;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {

        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }
    public function create(Profile $profile)
    {
        $profile = auth()->user()->profile;
        return view('projects.create', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request, Profile $profile)
    {
        $validatedData = $request->validated();
        $validatedData['profile_id'] = $profile->id;

        if ($request->hasFile('project_photo')) {
            $photoPath = $request->file('project_photo')->store('projects', 'public');

            $validatedData['project_photo'] = $photoPath;
        }

        $project = Project::create($validatedData);

        $successMessage = 'Congratulations, ' . $profile->name . '! Your project was added';

        return redirect()
            ->route('dashboard', ['profile' => $profile, 'project' => $project->id])
            ->with('success', $successMessage);
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project, Profile $profile)
    {

        return view('projects.show', compact('project', 'profile'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile, Project $project)
    {
        return view('projects.create', compact('profile', 'project'));
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
        $user = $project->user;

        $successMessage = 'Congratulations, ' . $user->name . '! Your project was updated';

        return redirect()
            ->route('projects.show', compact('project', 'user'))
            ->with('success', $successMessage);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Project $project)
    {
        // Find the project by its ID and make sure it belongs to the specified user

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
