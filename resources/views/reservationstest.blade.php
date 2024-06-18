@extends('layouts.appsecond')

@section('title', 'Réservations')

@section('content')
    <section class="bg-custom-blue2 py-12 px-4 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Div pour l'erreur de chargement de la page -->
            <div class="text-white p-8 mb-8 flex flex-col items-center">
                <h2 class="text-4xl font-semibold mb-4">RÉSERVATIONS</h2>

                <!-- SVG -->
                <div class="flex items-center mt-4">
                    <!-- Premier SVG et paragraphe -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         class="fill-current text-white mr-2">
                        <path
                            d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z"/>
                    </svg>
                    <p class="text-white">HOME</p>
                    <!-- Deuxième SVG et paragraphe -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         class="fill-current text-white ml-4 mr-2">
                        <path d="m19 12-7-6v5H6v2h6v5z"/>
                    </svg>
                    <p class="text-white">RÉSERVATIONS</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Affichage des réservations -->
    <section class="bg-white p-8 rounded-lg shadow-lg">
        <div class="max-w-4xl mx-auto">
            <!-- Réservations à venir -->
            <h2 class="text-2xl font-semibold mb-4">Réservations à Venir</h2>
            @php
                $hasUpcomingReservations = false;
            @endphp

            @foreach ($reservations as $reservation)
                @if (Carbon\Carbon::parse($reservation->fin_date)->isFuture())
                    @php
                        $hasUpcomingReservations = true;
                    @endphp
                    <div class="bg-gray-100 p-4 md:p-6 rounded-lg shadow mb-4 flex flex-col md:flex-row items-center">
                        @if ($reservation->carousel && $reservation->carousel->carouselPictureMany->isNotEmpty())
                            <div class="md:w-1/3 pr-0 md:pr-6 mb-4 md:mb-0">
                                <img src="{{ asset($reservation->carousel->carouselPictureMany->first()->images) }}"
                                     alt="Image du carousel" class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endif
                        <div class="md:w-2/3">
                            <h3 class="text-xl font-semibold mb-2">{{ $reservation->carousel->name }}</h3>
                            <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold mb-2 md:mb-0">Réservation #{{ $reservation->id }}</h3>
                                <h3 class="text-xl font-semibold mb-2 md:mb-0">{{ $reservation->status }}</h3>
                            </div>
                            <p class="text-gray-700 mb-4">Date : {{ \Carbon\Carbon::parse($reservation->debut_date)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($reservation->fin_date)->format('d/m/Y') }}</p>
                            <a href="/manège/détails/{{ $reservation->carousel->id }}"
                               class="mt-2 bg-custom-blue-header hover:bg-blue-600 active:bg-custom-blue-header text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline self-end">Détails</a>
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- Vérifie s'il y a des réservations à venir -->
            @if (!$hasUpcomingReservations)
                <p class="text-gray-600">Vous n'avez aucune réservation à venir pour le moment.</p>
            @endif

            <!-- Historique des Réservations -->
            <h2 class="text-2xl font-semibold mb-4 mt-8">Historique des Réservations</h2>
            @php
                $hasPastReservations = false;
            @endphp

            @foreach ($reservations as $reservation)
                @if (Carbon\Carbon::parse($reservation->fin_date)->isPast())
                    @php
                        $hasPastReservations = true;
                    @endphp
                    <div class="bg-gray-100 p-4 md:p-6 rounded-lg shadow mb-4 flex flex-col md:flex-row items-center">
                        @if ($reservation->carousel && $reservation->carousel->carouselPictureMany->isNotEmpty())
                            <div class="md:w-1/3 pr-0 md:pr-6 mb-4 md:mb-0">
                                <img src="{{ asset($reservation->carousel->carouselPictureMany->first()->images) }}"
                                     alt="Image du carousel" class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endif
                        <div class="md:w-2/3">
                            <h3 class="text-xl font-semibold mb-2">{{ $reservation->carousel->name }}</h3>
                            <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold mb-2 md:mb-0">Réservation #{{ $reservation->id }}</h3>
                                <h3 class="text-xl font-semibold mb-2 md:mb-0">{{ $reservation->status }}</h3>
                            </div>
                            <p class="text-gray-700 mb-4">Date : {{ \Carbon\Carbon::parse($reservation->debut_date)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($reservation->fin_date)->format('d/m/Y') }}</p>
                            <a href="/manège/détails/{{ $reservation->carousel->id }}"
                               class="mt-2 bg-custom-blue-header hover:bg-blue-600 active:bg-custom-blue-header text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline self-end">Détails</a>
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- Vérifie s'il y a un historique des réservations -->
            @if (!$hasPastReservations)
                <p class="text-gray-600 mt-8">Aucun historique de réservations trouvé.</p>
            @endif
        </div>
    </section>
@endsection
