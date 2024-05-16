@extends('layouts.appsecond')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Réservations du Carrousel "{{ $carousel->name }}"</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($reservations as $reservation)
        <div class="border border-gray-300 p-4 rounded-lg">
            <p class="text-lg font-semibold">Réservation #{{ $reservation->id }}</p>
            <p><span class="font-semibold">Date de Début:</span> {{ $reservation->debut_date }}</p>
            <p><span class="font-semibold">Date de Fin:</span> {{ $reservation->fin_date }}</p>
            <p><span class="font-semibold">Status:</span> {{ $reservation->status }}</p>
            <p><span class="font-semibold">Nom du Carrousel:</span> {{ $reservation->carousel->name }}</p>
            <p><span class="font-semibold">Nom de l'Utilisateur:</span> {{ $reservation->user->name }}</p>
            <p><span class="font-semibold">Email:</span> {{ $reservation->user->email }}</p>
            <p><span class="font-semibold">Adresse:</span> {{ $reservation->user->address }}</p>
            <div class="mt-4">
                <a href='/reservation/update/{{$reservation->id}}' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Modifier</a>
                <form action="{{''}}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
