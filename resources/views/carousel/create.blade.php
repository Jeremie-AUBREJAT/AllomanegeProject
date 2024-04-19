@extends('layouts.appsecond')

@section('content')
<div class="flex justify-center">
    <div class="w-1/2 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl mb-4">Création d'un produit</h1>
        <form method="POST" action="{{url('/carousel/create')}}" enctype="multipart/form-data">
            @csrf

             {{-- Champ nom --}}
             <div class="mb-4">
                <label for="name" class="block mb-2">Nom :</label>
                <input type="text" name="name" id="name" value="{{old('name')}}" class="border rounded-md px-3 py-2 w-full">
            </div>
           
            {{-- Message d'erreur pour le nom --}}
            @error('name')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ taille --}}
            <div class="mb-4">
                <label for="size" class="block mb-2">Taille :</label>
                <input type="text" name="size" id="size" value="{{old('size')}}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour la taille --}}
            @error('size')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ poid --}}
            <div class="mb-4">
                <label for="weight" class="block mb-2">Poid :</label>
                <input type="text" name="weight" id="weight" value="{{old('weight')}}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour la poid --}}
            @error('weight')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ puissance en Kwatt --}}
            <div class="mb-4">
                <label for="watt_power" class="block mb-2">Puissance en Kwatt :</label>
                <input type="text" name="watt_power" id="watt_power" value="{{old('watt_power')}}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour la puissance en Kwatt --}}
            @error('watt_power')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ localisation du manèges --}}
            <div class="mb-4">
                <label for="localization" class="block mb-2">Localisation :</label>
                <input type="text" name="localization" id="localization" value="{{old('localization')}}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour la localisation --}}
            @error('localization')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ localisation du manèges --}}
            <div class="mb-4">
                <label for="install_time" class="block mb-2">Temps d' installation en heure(s) :</label>
                <input type="text" name="install_time" id="install_time" value="{{old('install_time')}}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour la localisation --}}
            @error('install_time')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror


            {{-- Champ prix --}}
            <div class="mb-4">
                <label for="price" class="block mb-2">Prix :</label>
                <input type="number" value="{{old('price')}}" name="price" id="price" step="0.01" required class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour le prix --}}
            @error('price')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ image --}}
            <div class="mb-4">
                <label for="images" class="block mb-2">Image :</label>
                <input type="file" name="images" id="images" accept="image/*" class="border rounded-md px-3 py-2 w-full">
                <p>Image actuelle :</p>
                <img src="/images/{{ old('images') }}">
            </div>
            


            {{-- Champ pour la description --}}
            <div class="mb-4">
                <label for="description" class="block mb-2">Description :</label>
                <textarea name="description" id="description" required class="border rounded-md px-3 py-2 w-full">{{old('description')}}</textarea>
            </div>
            {{-- Message d'erreur pour la description --}}
            @error('description')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ catégorie --}}
            <div class="mb-4">
                <label for="category" class="block mb-2">Catégorie :</label>
                <select name="category" id="category" required class="border rounded-md px-3 py-2 w-full">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Message d'erreur pour les catégories --}}
            @error('category')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Bouton créer produit --}}
            <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 active:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Créer un produit</button>
        </form> 
        <a href="/category/edit" class="block mt-4 bg-green-900 hover:bg-green-800 active:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Créer une catégorie</a>
        {{-- Lien retour catalogue produit --}}
        <a href="/product/view" class="block mt-4 bg-blue-900 hover:bg-blue-800 active:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Retour catalogue produit</a>
    </div>
</div>
@endsection
