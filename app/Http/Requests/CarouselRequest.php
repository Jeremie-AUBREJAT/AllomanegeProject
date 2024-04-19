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
            //
            // 'name'=>'required|min:2|max:100',
            // 'size'=>'required|min:1|numeric',
            // 'weight'=>'required|min:1|numeric',
            // 'watt_power'=>'required|min:1|numeric',
            // 'install_time'=>'required|min:1|numeric',
            // 'description'=>'required|min:10',
            // 'localization'=>'required|min:1',
            // 'price'=>'required|min:1|numeric',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Veuillez entrez un nom',
            'name.min' => 'Veuillez entrez au moins 2 caractères',
            'name.max' => 'Veuillez entrez moins de 100 caractères',
            'size.required' => 'Veuillez entrez une taille',
            'size.min' => `Veuillez n'entrer au moins un caractère numérique`,
            'size.numeric' => `Veuillez n'entrer que des valeurs numériques`,
            'watt_power.required'=>'Entrez une puissance',
            'watt_power.min'=>'Entrez au minimum un caractère numérique',
            'watt_power.numeric'=>'Entrez des caractères numériques',
            'install_time.required'=>`Veuillez entrer un temps d'installation`,
            'install_time.min'=>`Veuillez entrer au moins un caractère numérique`,
            'install_time.numerique'=>`Veuillez entrer que des caractères numériques`,
            'description.required'=>'Veuillez entrer une description',
            'description.min'=>'Veuillez entrer au moins 10 caractères',
            'localization.required'=>'Vueillez entrer une localisation principale',
            'localization.min'=>'Vueillez entrer au moins un caractère',
            'price.required'=>'Veuillez entrer un prix',
            'price.min'=>'Veuillez entrer au moin un caractère numérique positif',
            'price.numeric'=>'Veuillez entrer que des caractères numériques',
        ];
    }
}
