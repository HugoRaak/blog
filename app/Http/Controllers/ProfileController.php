<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $this->authorize('update', $request->user());
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->authorize('update', $request->user());
        if ($picture = $request->validated('picture')) {
            if ($request->user()?->picture) {
                Storage::disk('public')->delete($request->user()->picture);
            }
            if ($request->user() !== null) {
                $request->user()->picture = $picture->store('images/profile', 'public');
            }
        }
        $request->user()?->fill($request->validated());

        if ($request->user()?->isDirty('email')) {
            if ($request->user() !== null) {
                $request->user()->email_verified_at = null;
            }
        }

        $request->user()?->save();

        return Redirect::route('profile.edit')->with('success', 'Votre profil a été modifié');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->authorize('delete', $request->user());
        $user = $request->user();

        Auth::logout();

        $user?->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Le compte a été supprimé');
    }
}
