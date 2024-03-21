<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::all();
        return view('profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileStoreRequest $request, User $user)
    { {
            $validatedData = $request->validated();
            $validatedData['user_id'] = auth()->user()->id;

            if ($request->hasFile('profile_photo')) {
                $photoPath = $request->file('profile_photo')->store('profiles', 'public');

                $validatedData['profile_photo'] = $photoPath;
            }

            $profile = Profile::create($validatedData);

            $successMessage = 'Congratulations, ' . $user->name . '! Your profile was created';

            return redirect()
                ->route('profiles.show', compact('user', 'profile'))
                ->with('success', $successMessage);
        }
    }

    public function show(Profile $profile)
    {
        $projects = $profile->projects()->get();
        $profile->increment('views');
        return view('dashboard', compact('projects', 'profile'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request, Profile $profile): RedirectResponse
    {
        $request->profile()->fill($request->validated());
        $request->profile()->views = 0;
        $categories = Profile::$categories;
        $locations = Profile::$locations;



        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('accounts', 'public');
            $request->profile()->profile_photo = $photoPath;
        }


        $request->user()->save();
        $successMessage = 'Congratulations, ' . $profile->name . '! Your account was updated';
        return redirect()->route('dashboard', compact('locations', 'categories'))
            ->with('success', $successMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
