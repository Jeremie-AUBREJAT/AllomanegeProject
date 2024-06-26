@extends('layouts.appsecond')
@section('title', 'ajouter-un-manège')
@section('content')
    <div class="flex justify-center my-4">
        <div class="w-2/3 bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl mb-4">Création d'un manège</h1>

            <form method="POST" id="carouselForm" action="{{ url('/carousel/create') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Colonne gauche pour les champs -->
                    <div>
                        <!-- Champ nom -->
                        <div class="mb-4">
                            <label for="name" class="block mb-2">Nom du manège :</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="border rounded-md px-3 py-2 w-full">
                            @error('name')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="nameError" class="text-red-500 font-semibold" ></span>
                        </div>

                        <!-- Champ taille -->
                        <div class="mb-4">
                            <label for="length" class="block mb-2">Longeur en mètre(s) :</label>
                            <input type="text" name="length" id="length" value="{{ old('length') }}"
                                class="border rounded-md px-3 py-2 w-full">
                            @error('length')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="lengthError" class="text-red-500 font-semibold" ></span>
                        </div>
                        <div class="mb-4">
                            <label for="width" class="block mb-2">Largeur en mètre(s) :</label>
                            <input type="text" name="width" id="width" value="{{ old('width') }}"
                                class="border rounded-md px-3 py-2 w-full">
                            @error('width')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="widthError" class="text-red-500 font-semibold" ></span>
                        </div>

                        <!-- Champ poids -->
                        <div class="mb-4">
                            <label for="weight" class="block mb-2">Poids en tonnes :</label>
                            <input type="text" name="weight" id="weight" value="{{ old('weight') }}"
                                class="border rounded-md px-3 py-2 w-full">
                            @error('weight')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="weightError" class="text-red-500 font-semibold" ></span>
                        </div>

                        <!-- Champ puissance en Kwatt -->
                        <div class="mb-4">
                            <label for="watt_power" class="block mb-2">Puissance en Kwatt :</label>
                            <input type="text" name="watt_power" id="watt_power" value="{{ old('watt_power') }}"
                                class="border rounded-md px-3 py-2 w-full autocomplete">
                            @error('watt_power')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="watt_powerError" class="text-red-500 font-semibold" ></span>
                        </div>
                        <!-- Champ prix -->
                        <div class="mb-4">
                            <label for="price" class="block mb-2">Prix :</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01"
                                required class="border rounded-md px-3 py-2 w-full">
                            @error('price')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="priceError" class="text-red-500 font-semibold" ></span>
                        </div>
                        <!-- Champ temps d'installation -->
                        <div class="mb-4">
                            <label for="install_time" class="block mb-2">Temps d'installation en heure(s) :</label>
                            <input type="text" name="install_time" id="install_time" value="{{ old('install_time') }}"
                                class="border rounded-md px-3 py-2 w-full">
                            @error('install_time')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="install_timeError" class="text-red-500 font-semibold" ></span>
                        </div>

                        <!-- Champ description -->
                        <div class="mb-4">
                            <label for="description" class="block mb-2">Description :</label>
                            <textarea name="description" id="description" required class="border rounded-md px-3 py-2 w-full">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="descriptionError" class="text-red-500 font-semibold" ></span>
                        </div>

                        <!-- Champ catégorie -->
                        <div class="mb-4">
                            <label for="category" class="block mb-2">Catégorie :</label>
                            <select name="category" id="category" required class="border rounded-md px-3 py-2 w-full">
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="text-2xl mt-6">Localisation de votre manège: </div>
                        <!-- Champs localisation -->
                        <div class="mb-4 mt-4">
                            <label for="search" class="block mb-2">Recherche adresse :</label>
                            <div class="relative">
                                <input type="text" id="search" placeholder="Recherche adresse..."
                                    class="search-input border rounded-md px-3 py-2 w-full pl-10">
                                <div id="search-suggestions" class="autocomplete-suggestions"></div>
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.9 14.32a8 8 0 111.42-1.42l4.6 4.6a1 1 0 01-1.42 1.42l-4.6-4.6zM8 14A6 6 0 108 2a6 6 0 000 12z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="street_name" class="block mb-2">Nom de rue :</label>
                            <input type="text" name="street_name" id="street_name" value="{{ old('street_name') }}"
                                class="border rounded-md px-3 py-2 w-full">
                            @error('street_name')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="street_nameError" class="text-red-500 font-semibold" ></span>
                            
                        </div>
                        <div class="mb-4">
                            <label for="street_number" class="block mb-2">Numéro de rue :</label>
                            <input type="text" name="street_number" id="street_number"
                                value="{{ old('street_number') }}"
                                class="border rounded-md px-3 py-2 w-full">
                            @error('street_number')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="street_numberError" class="text-red-500 font-semibold" ></span>
                        </div>

                        <div class="mb-4">
                            <label for="postal_code" class="block mb-2">Code postal :</label>
                            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}"
                                class="border rounded-md px-3 py-2 w-full autocomplete">
                            @error('postal_code')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="postal_codeError" class="text-red-500 font-semibold" ></span>
                        </div>
                        <div class="mb-4">
                            <label for="city" class="block mb-2">Ville :</label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}"
                                class="border rounded-md px-3 py-2 w-full autocomplete">
                            @error('city')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="cityError" class="text-red-500 font-semibold" ></span>
                        </div>
                        <div class="mb-4">
                            <label for="country" class="block mb-2">Pays :</label>
                            <input type="text" name="country" id="country" value="{{ old('country', 'France') }}"
                                class="border rounded-md px-3 py-2 w-full autocomplete">
                            @error('country')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            <span id="countryError" class="text-red-500 font-semibold" ></span>
                        </div>


                    </div>

                    <!-- Colonne droite pour les images -->
                    <div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('showManualCoords'))
                            <label for="latitude" class="block mb-2">Latitude :</label>
                            <input type="text" id="latitude2" name="latitude2" value="{{ old('latitude') }}"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2">
                            <label for="longitude" class="block mb-2">Longitude :</label>
                            <input type="text" id="longitude2" name="longitude2" value="{{ old('longitude') }}"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2">
                        @endif

                        <!-- Champ image -->
                        <div id="imageFields" class="mb-4">
                            <span id="imageCreateError" class="text-red-500 font-semibold" ></span>
                            <label for="imageCreate" class="block mb-2">Image(s) au format "JPG" ou "JPEG":</label>
                            <input type="file" name="imageCreate[]" id="imageCreate" accept="image/*" multiple
                                class="border rounded-md px-3 py-2 w-full">
                            @error('imageCreate')
                                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                            @enderror
                            
                            <div id="previewContainer" class="mt-4"></div>
                            <button id="addImageField" type="button"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Ajouter
                            une autre image</button>
                        </div>
                        
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white rounded-md px-4 py-2">Créer</button>
                </div>
            </form>
            @if (Auth::user()->role_as == '1' || Auth::user()->role_as == '2')
                <div class="flex justify-center mt-4">
                    <a href="{{ url('/carousel') }}" class="bg-green-500 text-white rounded-md px-4 py-2">Retour à la
                        liste</a>
                </div>
            @endif
        </div>
    </div>
@endsection
