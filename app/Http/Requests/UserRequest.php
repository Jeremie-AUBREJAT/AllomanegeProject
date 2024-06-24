<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette demande.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtenez les règles de validation qui s'appliquent à la demande.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100', 'min:2'],
            'surname' => ['required', 'string', 'max:100', 'min:2'],
            'compagny' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',      // doit contenir au moins une majuscule
                'regex:/[a-z]/',      // doit contenir au moins une minuscule
                'regex:/[0-9]/',      // doit contenir au moins un chiffre
                'regex:/[\W_]/',      // doit contenir au moins un caractère spécial
                'max:100'
            ],
            'street_number' => ['nullable', 'string', 'max:20'],
            'street_name' => ['required', 'string', 'max:100', 'min:2'],
            'postal_code' => ['required', 'string', 'max:20', 'min:2'],
            'city' => ['required', 'string', 'max:100', 'min:2'],
            'country' => ['required', 'string', 'max:100', 'min:2'],
            'phone_number' => ['required', 'string', 'max:50', 'min:10'],
            // 'role' => ['required', 'string', 'in:user,admin,super_admin'],
            'rgpd_consent' => ['required', 'accepted'],
        ];
    }

    /**
     * Obtenez les messages d'erreur personnalisés pour la validation des attributs.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Le champ nom est requis.',
            'name.string' => 'Le champ nom doit être une chaîne de caractères.',
            'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
            'name.min' => 'Le champ nom doit avoir minimum :min caractères.',

            'surname.required' => 'Le champ prénom est requis.',
            'surname.string' => 'Le champ prénom doit être une chaîne de caractères.',
            'surname.max' => 'Le champ prénom ne doit pas dépasser :max caractères.',
            'surname.min' => 'Le champ prénom doit avoir minimum :min caractères.',

            'compagny.string' => 'Le champ compagnie doit être une chaîne de caractères.',

            'email.required' => 'Le champ email est requis.',
            'email.string' => 'Le champ email doit être une chaîne de caractères.',
            'email.email' => 'Le champ email doit être une adresse email valide.',
            'email.max' => 'Le champ email ne doit pas dépasser :max caractères.',
            'email.unique:users' => 'Vous possedez deja un compte ou cette adresse est déja utilisée',

            'password.required' => 'Le champ mot de passe est requis1.',
            'password.string' => 'Le champ mot de passe doit être une chaîne de caractères.',
            'password.min' => 'Le champ mot de passe doit comporter au moins :min caractères.',
            'password.regex' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.',
            'password.max' => 'Le champ mot de passe ne doit pas dépasser :max caractères.',

            'street_number.string' => 'Le champ numéro de rue doit être une chaîne de caractères.',
            'street_number.max' => 'Le champ numéro de rue ne doit pas dépasser :max caractères.',

            'street_name.required' => 'Le champ nom de rue est requis.',
            'street_name.string' => 'Le champ nom de rue doit être une chaîne de caractères.',
            'street_name.max' => 'Le champ nom de rue ne doit pas dépasser :max caractères.',
            'street_name.min' => 'Le champ nom de rue doit avoir minimum :min caractères.',

            'postal_code.required' => 'Le champ code postal est requis.',
            'postal_code.string' => 'Le champ code postal doit être une chaîne de caractères.',
            'postal_code.max' => 'Le champ code postal ne doit pas dépasser :max caractères.',
            'postal_code.min' => 'Le champ code postal doit avoir minimum :min caractères.',

            'city.required' => 'Le champ ville est requis.',
            'city.string' => 'Le champ ville doit être une chaîne de caractères.',
            'city.max' => 'Le champ ville ne doit pas dépasser :max caractères.',
            'city.min' => 'Le champ ville doit avoir minimum :min caractères.',

            'country.required' => 'Le champ pays est requis.',
            'country.string' => 'Le champ pays doit être une chaîne de caractères.',
            'country.max' => 'Le champ pays ne doit pas dépasser :max caractères.',
            'country.min' => 'Le champ pays doit avoir minimum :min caractères.',

            'phone_number.required' => 'Le champ numéro de téléphone est requis.',
            'phone_number.string' => 'Le champ numéro de téléphone doit être une chaîne de caractères.',
            'phone_number.max' => 'Le champ numéro de téléphone ne doit pas dépasser :max caractères.',
            'phone_number.min' => 'Le champ numéro de téléphone doit avoir minimum :min caractères.',

            'role.required' => 'Le champ rôle est requis.',
            'role.string' => 'Le champ rôle doit être une chaîne de caractères.',
            'role.in' => 'Le champ rôle doit être l\'un des suivants : :values.',

            'rgpd_consent.required' => 'Vous devez accepter les politiques de confidentialité et les conditions générales.',
            'rgpd_consent.accepted' => 'Vous devez accepter les politiques de confidentialité et les conditions générales.',
        ];
    }
}
