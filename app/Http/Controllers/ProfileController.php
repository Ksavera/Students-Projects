<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{



    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $student): RedirectResponse
    {
        $request->user()->fill($request->validated());
        $request->user()->views = 0;
        $categories = User::$categories;
        $locations = User::$locations;

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profiles', 'public');
            $request->user()->profile_photo = $photoPath;
        }

        session(['profileUpdateUsed' => true]);
        $request->user()->save();
        $successMessage = 'Congratulations, ' . $student->name . '! Your profile was updated';
        return Redirect::route('dashboard', compact('locations', 'categories'))
            ->with('success', $successMessage);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
