<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarouselRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'price' => ['required', 'numeric', 'min:1'],
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'length' => ['required', 'numeric'],
            'width' => ['required', 'numeric'],
            'weight' => ['required', 'integer'],
            'watt_power' => ['required', 'integer'],
            'install_time' => ['required', 'numeric'],
            'description' => ['required', 'min:10', 'max:500', 'string'],
            'street_number' => ['nullable', 'string', 'max:20'],
            'street_name' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:1'],
            'imageCreate' => ['required', 'max:5'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Le champ nom est requis.',
            'name.string' => 'Le champ nom doit être une chaîne de caractères.',
            'name.min' => 'Le champ nom doit comporter au moins :min caractères.',
            'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',

            'length.required' => 'Le champ longueur est requis.',
            'length.numeric' => 'Le champ longueur doit être un nombre.',

            'width.required' => 'Le champ largeur est requis.',
            'width.numeric' => 'Le champ largeur doit être un nombre.',

            'weight.required' => 'Le champ poids est requis.',
            'weight.integer' => 'Le champ poids doit être un nombre entier.',

            'watt_power.required' => 'Le champ puissance en watts est requis.',
            'watt_power.integer' => 'Le champ puissance en watts doit être un nombre entier.',

            'install_time.required' => 'Le champ temps d\'installation est requis.',
            'install_time.numeric' => 'Le champ temps d\'installation doit être un nombre.',

            'description.required' => 'Le champ description est requis.',
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'description.min' => 'Le champ description doit comporter au moins :min.',

            'street_number.string' => 'Le champ numéro de rue doit être une chaîne de caractères.',
            'street_number.max' => 'Le champ numéro de rue ne doit pas dépasser :max caractères.',

            'street_name.required' => 'Le champ nom de rue est requis.',
            'street_name.string' => 'Le champ nom de rue doit être une chaîne de caractères.',
            'street_name.max' => 'Le champ nom de rue ne doit pas dépasser :max caractères.',

            'postal_code.required' => 'Le champ code postal est requis.',
            'postal_code.string' => 'Le champ code postal doit être une chaîne de caractères.',
            'postal_code.max' => 'Le champ code postal ne doit pas dépasser :max caractères.',

            'city.required' => 'Le champ ville est requis.',
            'city.string' => 'Le champ ville doit être une chaîne de caractères.',
            'city.max' => 'Le champ ville ne doit pas dépasser :max caractères.',

            'country.required' => 'Le champ pays est requis.',
            'country.string' => 'Le champ pays doit être une chaîne de caractères.',
            'country.max' => 'Le champ pays ne doit pas dépasser :max caractères.',

            'price.required' => 'Le champ prix est requis.',
            'price.numeric' => 'Le champ prix doit être un nombre.',
            'price.min' => 'Le champ prix doit être au moins :min.',

            'imageCreate.required' => 'Vous devez ajouter au moins une image.',
            'imageCreate.max' => 'Vous ne pouvez pas ajouter plus de :max images.',
        ];
    }
}
