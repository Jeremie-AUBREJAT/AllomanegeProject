@extends('layouts.appsecond')

@section('content')
<div class="flex justify-center">
    <div class="w-1/2 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl mb-4">Création d'un produit</h1>
        <form method="POST" action="{{url('/picture/create')}}" enctype="multipart/form-data">
            @csrf

           

            <div class="mb-4">
                <label for="imageCreate" class="block mb-2">Image :</label>
                <input type="file" name="imageCreate" id="image" value="{{ old('image') }}" class="border rounded-md px-3 py-2 w-full">
            </div>
            {{-- Message d'erreur pour l'imaghe --}}
            @error('imageCreate')
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
