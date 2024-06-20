@extends('layouts.appsecond')
@section('title', 'Tableau-de-bord')
@section('content')
<div class="container mx-auto p-4 my-8">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="text-lg font-semibold mb-4">Options</div>

                <!-- Bouton pour afficher toutes les manèges -->
                <a href="/carousel/view" class="w-full bg-blue-500 hover:bg-blue-700 text-white text-xl font-bold py-2 px-4 rounded my-6 block text-center">Tous les manèges</a>
                
                <!-- Bouton pour afficher toutes les catégories -->
                <a href="/category/edit" class="w-full bg-cyan-500 hover:bg-cyan-700 text-white text-xl font-bold py-2 px-4 rounded my-6 block text-center">Toutes les categories</a>
                <!-- Bouton pour afficher tous les utilisateurs -->
                <a href="/allusers" class="w-full bg-green-500 hover:bg-green-700 text-white text-xl font-bold py-2 px-4 rounded my-6 block text-center">Tous les utilisateurs</a>

                <!-- Bouton pour afficher toutes les réservations -->
                <a href="/dashboard_SA/allreservations" class="w-full bg-yellow-500 hover:bg-yellow-700 text-xl text-white font-bold py-2 px-6 rounded my-4 block text-center">Toutes les réservations</a>
            </div>
        </div>
    </div>
</div>
@endsection