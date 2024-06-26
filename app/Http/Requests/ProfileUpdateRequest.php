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
            'name' => ['required', 'string', 'max:100', 'min:2'],
            'surname' => ['required', 'string', 'max:100', 'min:2'],
            'compagny' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'street_number' => ['nullable', 'string', 'max:20'],
            'street_name' => ['required', 'string', 'max:100', 'min:2'],
            'postal_code' => ['required', 'string', 'max:20', 'min:2'],
            'city' => ['required', 'string', 'max:100', 'min:2'],
            'country' => ['required', 'string', 'max:100', 'min:2'],
            'phone_number' => ['required', 'string', 'max:50', 'min:10'],
        ];
    }
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


        ];
    }
}
