<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'surname' => ['required', 'min:2', 'string', 'max:255'],
            'compagny' => ['required', 'min:2', 'string', 'max:255'],
            'address' => ['required', 'min:2', 'string', 'max:255'],
            'zipcode' => ['required', 'numeric', 'digits:5'], // Ajout de la règle 'numeric'
            'phone_number' => ['required', 'numeric', 'digits:10'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Veuillez entrer un nom',
            'name.min' => 'Veuillez entrer au moins 2 caractères',
            'email.required' => 'Le champ email est requis.',
            'email.string' => 'Le champ email doit être une chaîne de caractères.',
            'email.lowercase' => 'Le champ email doit être en minuscules.',
            'email.email' => 'Le champ email doit être une adresse email valide.',
            'email.max' => 'Le champ email ne doit pas dépasser 255 caractères.',
            'surname.required' => 'Le champ prénom est requis.',
            'surname.min' => 'Le champ prénom doit comporter au moins 2 caractères.',
            'surname.string' => 'Le champ prénom doit être une chaîne de caractères.',
            'surname.max' => 'Le champ prénom ne doit pas dépasser 255 caractères.',
            'compagny.required' => 'Le champ entreprise est requis.',
            'compagny.min' => 'Le champ entreprise doit comporter au moins 2 caractères.',
            'compagny.string' => 'Le champ entreprise doit être une chaîne de caractères.',
            'compagny.max' => 'Le champ entreprise ne doit pas dépasser 255 caractères.',
            'address.required' => 'Le champ adresse est requis.',
            'address.min' => 'Le champ adresse doit comporter au moins 2 caractères.',
            'address.string' => 'Le champ adresse doit être une chaîne de caractères.',
            'address.max' => 'Le champ adresse ne doit pas dépasser 255 caractères.',
            'zipcode.numeric' => 'Veuillez entrer que des chiffres.',
            'zipcode.digits' => 'Veuillez entrer 5 chiffres.',
            'phone_number.numeric' => 'Veuillez entrer que des chiffres.',
            'phone_number.digits' => 'Veuillez entrer 10 chiffres.',

        ];
    }
}
