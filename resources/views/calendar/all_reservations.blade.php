@extends('layouts.appsecond')
@section('title', 'Toutes les réservations')
@section('content')

<div class="container mx-auto">
    <div class="grid grid-cols-2 gap-4">
        <!-- Colonnes pour les réservations en attente -->
        <div>
            <h2 class="text-3xl font-semibold my-4">Réservations en attente</h2>
            @foreach ($reservations as $reservation)
                @if ($reservation->status === 'pending')
                    <div class="border border-gray-300 p-4 rounded-lg mb-4 flex flex-wrap items-start">
                        <!-- Informations de réservation -->
                        <div class="w-full md:w-1/3">
                            <p class="text-2xl font-bold">Réservation N°: {{ $reservation->id }}</p>
                            <p class="text-lg"><span class="text-lg font-semibold">Nom du Manège: </span>
                                {{ $reservation->carousel->name }}</p>
                            <p class="text-lg"><span class="text-lg font-semibold">Statut: </span> {{ $reservation->status }}</p>
                        </div>
                        <!-- Dates -->
                        <div class="w-full md:w-1/3 mt-4 md:mt-0">
                            <p class="text-lg"><span class="text-lg font-semibold">Date de Début: </span>
                                {{ \Carbon\Carbon::parse($reservation->debut_date)->format('d/m/Y') }}</p>
                            <p class="text-lg"><span class="text-lg font-semibold">Date de Fin: </span>
                                {{ \Carbon\Carbon::parse($reservation->fin_date)->format('d/m/Y') }}</p>
                        </div>
                        <!-- Informations utilisateur -->
                        <div class="w-full md:w-1/3 mt-4 md:mt-0">
                            <p class="text-lg"><span class="text-lg font-semibold">Nom de l'Utilisateur: </span>
                                {{ $reservation->user->name }}</p>
                            <p class="text-lg"><span class="text-lg font-semibold">Email: </span>
                                {{ $reservation->user->email }}
                            </p>
                            <p class="text-lg"><span class="text-lg font-semibold">Adresse: </span>
                                {{ $reservation->user->address }}
                            </p>
                            <p class="text-lg"><span class="text-lg font-semibold">Code postal: </span>
                                {{ $reservation->user->zipcode }}
                            </p>
                        </div>
                        <!-- Boutons -->
                        <div class="w-full my-auto flex justify">
                            <a href='/reservation/update/{{ $reservation->id }}'
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">Modifier</a>
                            <form method="POST" action="{{ url('reservation/delete/' . $reservation->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <!-- Colonnes pour les réservations approuvées -->
        <div>
            <h2 class="text-3xl font-semibold my-4">Réservations approuvées</h2>
            @foreach ($reservations as $reservation)
                @if ($reservation->status === 'approved')
                    <div class="border border-gray-300 p-4 rounded-lg mb-4 flex flex-wrap items-start">
                        <!-- Informations de réservation -->
                        <div class="w-full md:w-1/3">
                            <p class="text-2xl font-bold">Réservation N°: {{ $reservation->id }}</p>
                            <p class="text-lg"><span class="text-lg font-semibold">Nom du Manège: </span>
                                {{ $reservation->carousel->name }}</p>
                            <p class="text-lg"><span class="text-lg font-semibold">Statut: </span> {{ $reservation->status }}</p>
                        </div>
                        <!-- Dates -->
                        <div class="w-full md:w-1/3 mt-4 md:mt-0">
                            <p class="text-lg"><span class="text-lg font-semibold">Date de Début: </span>
                                {{ \Carbon\Carbon::parse($reservation->debut_date)->format('d/m/Y') }}</p>
                            <p class="text-lg"><span class="text-lg font-semibold">Date de Fin: </span>
                                {{ \Carbon\Carbon::parse($reservation->fin_date)->format('d/m/Y') }}</p>
                        </div>
                        <!-- Informations utilisateur -->
                        <div class="w-full md:w-1/3 mt-4 md:mt-0">
                            <p class="text-lg"><span class="text-lg font-semibold">Nom de l'Utilisateur: </span>
                                {{ $reservation->user->name }}</p>
                                <p class="text-lg"><span class="text-lg font-semibold">Email: </span>
                                    {{ $reservation->user->email }}
                                </p>
                                <p class="text-lg"><span class="text-lg font-semibold">Adresse: </span>
                                    {{ $reservation->user->address }}
                                </p>
                                <p class="text-lg"><span class="text-lg font-semibold">Code postal: </span>
                                    {{ $reservation->user->zipcode }}
                                </p>
                            </div>
                            <!-- Boutons -->
                            <div class="w-full my-auto flex justify">
                                <a href='/reservation/update/{{ $reservation->id }}'
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">Modifier</a>
                                <form method="POST" action="{{ url('reservation/delete/' . $reservation->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endsection
    