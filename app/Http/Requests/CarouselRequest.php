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
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'size' => ['required', 'numeric'],
            'weight' => ['required', 'integer'],
            'watt_power' => ['required', 'integer'],
            'install_time' => ['required', 'numeric'],
            'description' => ['required', 'min:10', 'max:500', 'string'],
            'localization' => ['required', 'string', 'min:1', 'max:255'],
            'price' => ['required', 'numeric', 'min:1'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Le champ nom est requis.',
            'name.string' => 'Le champ nom doit être une chaîne de caractères.',
            'name.min' => 'Le champ nom doit comporter au moins :min caractères.',
            'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',

            'size.required' => 'Le champ taille est requis.',
            'size.numeric' => 'Le champ taille doit être un nombre.',

            'weight.required' => 'Le champ poids est requis.',
            'weight.integer' => 'Le champ poids doit être un nombre entier.',

            'watt_power.required' => 'Le champ puissance en watts est requis.',
            'watt_power.integer' => 'Le champ puissance en watts doit être un nombre entier.',

            'install_time.required' => 'Le champ temps d\'installation est requis.',
            'install_time.numeric' => 'Le champ temps d\'installation doit être un nombre.',

            'description.required' => 'Le champ description est requis.',
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'description.min' => 'Le champ description doit comporter au moins :min caractères.',
            'description.max' => 'Le champ description ne doit pas dépasser :max caractères.',

            'localization.required' => 'Le champ localisation est requis.',
            'localization.string' => 'Le champ localisation doit être une chaîne de caractères.',
            'localization.min' => 'Le champ localisation doit comporter au moins :min caractère.',
            'localization.max' => 'Le champ localisation ne doit pas dépasser :max caractères.',

            'price.required' => 'Le champ prix est requis.',
            'price.numeric' => 'Le champ prix doit être un nombre.',
            'price.min' => 'Le champ prix doit être au moins :min.',
        ];
    }
}
