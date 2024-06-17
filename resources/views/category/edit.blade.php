@extends('layouts.appsecond')
@section('content')
<h1 class="text-2xl font-bold mb-4">Catégorie:</h1>

<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    <a href="/category/create">Créer une catégorie</a>
</button>
<button class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">
    <a href="/dashboard_SA">Retour au tableau de bord</a>
</button>
@foreach ($categories as $category)
    <div class="border border-gray-300 p-4 rounded mb-4">
        <p class="text-lg font-semibold">Nom catégorie : {{ $category->name }}</p>
        <p class="text-gray-700">Description catégorie: {{ $category->description }}</p>

        <!-- Bouton pour modifier une catégorie -->
        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-2">
            <a href="/category/update/{{ $category->id }}">Modifier une catégorie</a>
        </button>

        <!-- Formulaire pour supprimer une catégorie -->
        <form action="{{ url('/category/' . $category->id) }}" method="POST" class="mt-2">
            @csrf
            @method('DELETE')
            <input type="submit" value="Supprimer la catégorie"
                   class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
        </form>
    </div>



@endforeach
@endsection