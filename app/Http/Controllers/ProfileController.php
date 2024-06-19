<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


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
        $user = $request->user();

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->compagny = $request->compagny;
        $user->street_number = $request->street_number;
        $user->street_name = $request->street_name;
        $user->postal_code = $request->postal_code;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ], [
            'password.current_password' => 'Le mot de passe actuel est incorrect.',
            'password.required' => 'Entrez votre mot de passe.',
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


    //Methodes pour les Super_admin
    public function viewAllUsers()
    {
        // Vérifiez si l'utilisateur actuellement authentifié est un Super_admin
        if (Auth::user()->role === 'Super_admin') {
            // Si oui, récupérez tous les utilisateurs
            $users = User::all();

            // Vous pouvez maintenant utiliser la variable $users dans votre vue pour afficher la liste des utilisateurs
            return view('users/view', compact('users'));
        } else {
            // Si l'utilisateur actuel n'est pas un Super_admin, redirigez-le vers une autre vue ou affichez un message d'erreur
            abort(404);
        }
    }
    public function viewUserUpdateForm($id)
    {
        // Récupérer l'utilisateur à mettre à jour
        $user = User::find($id);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            abort(404); // Retourner une erreur 404 si l'utilisateur n'existe pas
        }

        // Vérifier si l'utilisateur est un super administrateur
        if (Auth::user()->role === 'Super_admin') {
            return view('users.updateForm')->with(["user" => $user]);
        }
        abort(404); // Retourner une erreur 403 (Accès refusé) si l'utilisateur n'est pas autorisé

    }
    public function userUpdate(Request $request, $id)
    {
        // Récupérer l'utilisateur à mettre à jour
        $user = User::find($id);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            abort(404); // Retourner une erreur 404 si l'utilisateur n'existe pas
        }

        // Vérifier si l'utilisateur est un Super_admin
        if (Auth::user()->role !== 'Super_admin') {
            abort(404); // Retourner une erreur 403 (Accès refusé) si l'utilisateur n'est pas autorisé
        }
        // Mettre à jour les données de l'utilisateur
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'compagny' => $request->compagny,
            'email' => $request->email,
            // 'password' => $request->password ? Hash::make($request->password) : $user->password,
            'street_number' => $request->street_number,
            'street_name' => $request->street_name,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
            'phone_number' => $request->phone_number,
            // 'role' => $request->role,
        ]);
        if (Auth::user()->role === 'Super_admin') {
            $user->update([
                'role' => $request->input('role')
            ]);
        }
        return view('users.updateForm')->with(["user" => $user]);
    }

    public function destroyUser($id)
{
    // Vérifier si l'utilisateur actuellement authentifié est un Super_admin
    if (Auth::check() && Auth::user()->role === 'Super_admin') {
        // Récupérer l'utilisateur à supprimer
        $user = User::find($id);

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

        // Supprimer l'utilisateur
        $user->delete();

        // Rediriger avec un message de succès ou afficher une vue appropriée
        return redirect()->route('profile.viewAllUsers')->with('success', 'Utilisateur et ses données associées supprimés avec succès');
        abort(404); // Retourner une erreur 403 (Accès refusé) si l'utilisateur n'est pas autorisé
    }
}

}
