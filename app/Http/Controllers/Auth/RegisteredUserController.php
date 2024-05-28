<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRegistrationEmail;
use App\Http\Requests\UserRequest;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request): RedirectResponse
{
    // Déterminer la valeur de rgpd_consent en fonction de la case à cocher
    $rgpd_consent = $request->has('rgpd_consent');

    $user = User::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'compagny' => $request->compagny,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'street_number' => $request->street_number,
        'street_name' => $request->street_name,
        'postal_code' => $request->postal_code,
        'city' => $request->city,
        'country' => $request->country,
        'phone_number' => $request->phone_number,
        'rgpd_consent' => $rgpd_consent, // Utiliser la valeur déterminée ci-dessus
        // 'role' => $request->role
    ]);

    if ($request->has('professional')) {
        // Envoyer un e-mail
        Mail::to(env('CONTACT_EMAIL'))->send(new SendRegistrationEmail($user));
    }

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}

//     public function viewAllUsers()
// {
//     // Vérifiez si l'utilisateur actuellement authentifié est un Super_admin
//     if (Auth::user()->role === 'Super_admin') {
//         // Si oui, récupérez tous les utilisateurs
//         $users = User::all();

//         // Vous pouvez maintenant utiliser la variable $users dans votre vue pour afficher la liste des utilisateurs
//         return view('users/view', compact('users'));
//     } else {
//         // Si l'utilisateur actuel n'est pas un Super_admin, redirigez-le vers une autre vue ou affichez un message d'erreur
//         abort(404);
//     }
// }
// public function viewUserUpdateForm($id)
// {   
//     // Récupérer l'utilisateur à mettre à jour
//     $user = User::find($id);

//     // Vérifier si l'utilisateur existe
//     if (!$user) {
//         abort(404); // Retourner une erreur 404 si l'utilisateur n'existe pas
//     }

//     // Vérifier si l'utilisateur est un super administrateur
//     if (Auth::user()->role === 'Super_admin') {
//         return view('users.updateForm')->with(["user" => $user]);
       
//     }
//     abort(404); // Retourner une erreur 403 (Accès refusé) si l'utilisateur n'est pas autorisé
    
// }
// public function userUpdate(Request $request, $id)
//     {
//         // Récupérer l'utilisateur à mettre à jour
//         $user = User::find($id);

//         // Vérifier si l'utilisateur existe
//         if (!$user) {
//             abort(404); // Retourner une erreur 404 si l'utilisateur n'existe pas
//         }

//         // Vérifier si l'utilisateur est un Super_admin
//         if (Auth::user()->role !== 'Super_admin') {
//             abort(404); // Retourner une erreur 403 (Accès refusé) si l'utilisateur n'est pas autorisé
//         }

//         // Valider les données du formulaire
//         // $request->validate([
//         //     'name' => ['required', 'string', 'max:255'],
//         //     'surname' => ['required', 'string', 'max:255'],
//         //     'compagny' => ['nullable', 'string', 'max:255'],
//         //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $id],
//         //     'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
//         //     'address' => ['nullable', 'string', 'max:255'],
//         //     'zipcode' => ['nullable', 'string', 'max:255'],
//         //     'phone_number' => ['nullable', 'string', 'max:255'],
//         //     'role' => ['required', 'string', 'in:user,admin,super_admin'],
//         // ]);

//         // Mettre à jour les données de l'utilisateur
//         $user->update([
//             'name' => $request->name,
//             'surname' => $request->surname,
//             'compagny' => $request->compagny,
//             'email' => $request->email,
//             // 'password' => $request->password ? Hash::make($request->password) : $user->password,
//             'address' => $request->address,
//             'zipcode' => $request->zipcode,
//             'phone_number' => $request->phone_number,
//             // 'role' => $request->role,
//         ]);
//         if (Auth::user()->role === 'Super_admin') {
//             $user->update([
//                 'role' => $request->input('role')
//             ]);
//         }
//         return view('users.updateForm')->with(["user" => $user]);
//     }

}
