@extends('layouts.appsecond')

@section('content')
<div class="container mx-auto px-8 py-8">
    <div class="flex justify-center">
        <a href="/allusers" class="mx-auto mt-12 bg-custom-blue-header hover:bg-blue-600 active:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Retour aux utilisateurs</a>
    </div>
    <h1 class="text-2xl font-bold mb-4">Modifier l'utilisateur</h1>
    
    <form action="{{ url('/update/' . $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block mb-2">Nom :</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="surname" class="block mb-2">Prénom :</label>
            <input type="text" id="surname" name="surname" value="{{ $user->surname }}" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="compagny" class="block mb-2">Compagnie :</label>
            <input type="text" id="compagny" name="compagny" value="{{ $user->compagny }}" class="w-full px-4 py-2 border rounded-md">
        </div>

        <div class="mb-4">
            <label for="email" class="block mb-2">Email :</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="street_number" class="block mb-2">Numéro de rue :</label>
            <input type="text" id="street_number" name="street_number" value="{{ $user->street_number }}" class="w-full px-4 py-2 border rounded-md">
        </div>

        <div class="mb-4">
            <label for="street_name" class="block mb-2">Nom de la rue :</label>
            <input type="text" id="street_name" name="street_name" value="{{ $user->street_name }}" class="w-full px-4 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label for="postal_code" class="block mb-2">Code postal :</label>
            <input type="text" id="postal_code" name="postal_code" value="{{ $user->postal_code }}" class="w-full px-4 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label for="city" class="block mb-2">Ville/Commune :</label>
            <input type="text" id="city" name="city" value="{{ $user->city }}" class="w-full px-4 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label for="country" class="block mb-2">Pays :</label>
            <input type="text" id="country" name="country" value="{{ $user->country }}" class="w-full px-4 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label for="phone_number" class="block mb-2">Numéro de téléphone :</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" class="w-full px-4 py-2 border rounded-md">
        </div>

        <div class="mb-4">
            <label for="role" class="block mb-2">Rôle :</label>
            <select name="role" id="role" class="w-full px-4 py-2 border rounded-md">
                @foreach (config('enumRole.role') as $key => $value)
                    <option value="{{ $key }}" {{ $user->role == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Mettre à jour</button>
    </form>
    <div class="flex justify-center">
        <form method="post" action="{{ url('/user/'.$user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            {{-- Bouton supprimer produit --}}
            <button type="submit"
                class="bg-red-500 hover:bg-red-700 active:bg-red-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline m-8">Supprimer</button>
        </form>
    </div>
    <div class="flex justify-center">
        <a href="/allusers" class="mx-auto mt-12 bg-custom-blue-header hover:bg-blue-600 active:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Retour aux utilisateurs</a>
    </div>
</div>
@endsection
