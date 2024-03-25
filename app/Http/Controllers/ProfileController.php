<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $locations = Profile::$locations;
        $categories = Profile::$categories;

        return view('profiles.create', compact('locations', 'categories'));
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

            $successMessage = 'Congratulations, ' . $profile->user->name . '! Your profile was created';

            return redirect()
                ->route('dashboard', compact('user', 'profile'))
                ->with('success', $successMessage);
        }
    }

    public function show(Profile $profile)
    {
        $profile->increment('views');
        $projects = $profile->projects()->get();
        if (Auth::check() && Auth::user()->id === $profile->user_id) {
            return view('dashboard', compact('projects', 'profile'));
        } else {
            return view('profiles.show', compact('projects', 'profile'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $locations = Profile::$locations;
        $categories = Profile::$categories;
        return view('profiles.create', compact('profile', 'locations', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request, Profile $profile): RedirectResponse
    {
        $profile->fill($request->validated());

        $profile->views = 0;

        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('accounts', 'public');
            $profile->profile_photo = $photoPath;
        }

        $profile->save();

        $successMessage = 'Congratulations, ' . $profile->user->name . '! Your account was updated';
        return redirect()->route('dashboard')->with('success', $successMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Profile $profile)
    {
        $user = Auth::user();
        if ($profile->profile_photo) {
            Storage::disk('public')->delete($profile->profile_photo);
        }
        $profile->delete();

        $successMessage = 'Congratulations, ' . $user->name . '! Your profile was deleted';

        return redirect()->route('dashboard')
            ->with('success', $successMessage);
    }
}
