<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    // Récupérer tous les carousels de l'utilisateur
    $carousels = $user->carousels;

    // Supprimer chaque carousel et ses images associées
    foreach ($carousels as $carousel) {
        // Récupérer toutes les images associées au carousel
        $carouselPictures = $carousel->carouselPictureMany;

        // Parcourir et supprimer les images associées
        foreach ($carouselPictures as $picture) {
            // Supprimer l'image de la base de données
            $picture->delete();

            // Supprimer le fichier physique de l'image
            if (file_exists(public_path($picture->images))) {
                unlink(public_path($picture->images));
            }
        }

        // Supprimer le carousel lui-même
        $carousel->delete();
    }

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
}

}
