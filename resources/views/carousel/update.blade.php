@extends('layouts.appsecond')

@section('content')
<div class="flex justify-center">
    <div class="w-1/2 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl mb-4">Modification de {{$carousel->name}}</h1>

        <form method="POST" action="{{ url('/update/'.$carousel->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Champ nom --}}
            <div class="mb-4">
                <label for="name" class="block mb-2">Nom :</label>
                <input type="text" name="name" id="name" value="{{$carousel->name}}" class="border rounded-md px-3 py-2 w-full">
            </div>
           
            {{-- Message d'erreur pour le nom --}}
            @error('name')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ taille --}}
            <div class="mb-4">
                <label for="size" class="block mb-2">Taille :</label>
                <input type="text" name="size" id="size" value="{{$carousel->size}}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour la taille --}}
            @error('size')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ poid --}}
            <div class="mb-4">
                <label for="weight" class="block mb-2">Poid :</label>
                <input type="text" name="weight" id="weight" value="{{$carousel->weight}}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour la poid --}}
            @error('weight')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ puissance en Kwatt --}}
            <div class="mb-4">
                <label for="watt_power" class="block mb-2">Puissance en Kwatt :</label>
                <input type="text" name="watt_power" id="watt_power" value="{{$carousel->watt_power}}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour la puissance en Kwatt --}}
            @error('watt_power')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ localisation du manèges --}}
            <div class="mb-4">
                <label for="localization" class="block mb-2">Localisation :</label>
                <input type="text" name="localization" id="localization" value="{{$carousel->localization}}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour la localisation --}}
            @error('localization')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Champ temps d installation --}}
            <div class="mb-4">
                <label for="install_time" class="block mb-2">Temps d'installation en heure "s" :</label>
                <input type="text" name="install_time" id="install_time" value="{{$carousel->install_time}}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour le temps d installation --}}
            @error('install_time')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            


            {{-- Champ prix --}}
            <div class="mb-4">
                <label for="price" class="block mb-2">Prix :</label>
                <input type="number" value="{{$carousel->price}}" name="price" id="price" step="0.01" required class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour le prix --}}
            @error('price')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror
            <div class="flex flex-wrap -mx-2">
                <!-- Pour chaque image du carrousel -->
                @foreach ($carousel->carouselPictureMany as $picture)
                    <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 px-2 mb-4">
                        <div class="mb-4">
                            <!-- Champ de fichier pour modifier l'image -->
                            <label for="imageUpdate{{$picture->id}}" class="block mb-2">Modifier Image {{$loop->index + 1}} :</label>
                            <input type="file" name="imageUpdate[]" id="imageUpdate{{$picture->id}}" accept="image/*" class="border rounded-md px-3 py-2 w-full">
                            <!-- Image actuelle -->
                            <p class="mt-2">Image actuelle :</p>
                            @if (!empty($picture->images))
                                <img src="{{ asset($picture->images) }}" alt="Image du carrousel" class="mt-2 w-full h-auto">
                                <!-- Champ caché pour conserver le nom de l'image actuelle -->
                                <input type="hidden" name="current_image[]" value="{{$picture->images}}">
                            @else
                                <p>Aucune image disponible</p>
                            @endif
                            <!-- Case à cocher pour supprimer l'image -->
                            <div class="mt-2">
                                <input type="checkbox" name="delete_image_id[]" value="{{$picture->id}}" id="deleteImage{{$picture->id}}">
                                <label for="deleteImage{{$picture->id}}">Supprimer cette image</label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Champ pour ajouter de nouvelles images -->
            <div class="mb-4">
                <label for="newImages" class="block mb-2">Ajouter de nouvelles images :</label>
                <input type="file" name="newImages[]" id="newImages" accept="image/*" multiple class="border rounded-md px-3 py-2 w-full">
            </div>
            



            

            {{-- Champ pour la description --}}
            <div class="mb-4">
                <label for="description" class="block mb-2">Description :</label>
                <textarea name="description" id="description" required class="border rounded-md px-3 py-2 w-full">{{$carousel->description}}</textarea>
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
                        <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Message d'erreur pour les catégories --}}
            @error('category')
                <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
            @enderror

            {{-- Bouton enregistrer modification --}}
            <button type="submit" class="bg-green-500 hover:bg-green-700 active:bg-green-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enregistrer</button>
        </form> 
        <a href="/carousel/view" class="block mt-4 bg-blue-900 hover:bg-blue-800 active:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Retour catalogue manèges</a>
    </div>
</div>

{{-- Formulaire de suppression --}}
<div class="flex justify-center">
    <form method="post" action="{{url('/carousel/'.$carousel->id)}}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        {{-- Bouton supprimer produit --}}
        <button type="submit" class="bg-red-500 hover:bg-red-700 active:bg-red-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline m-8">Supprimer</button>
    </form>
</div>
@endsection
