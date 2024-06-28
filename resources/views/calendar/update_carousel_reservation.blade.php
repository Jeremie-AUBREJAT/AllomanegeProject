@extends('layouts.appsecond')
@section('title', 'Modification réservation')
@section('content')
<div class="container mx-auto p-4 my-8">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="text-lg font-semibold mb-4">Modifier la réservation</div>

                <form method="POST" action="{{ url('reservation/update/'.$reservation->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="flex space-x-4 mb-4">
                        <!-- Champ pour la date de début -->
                        <div class="w-1/2">
                            <label for="debut_date" class="block text-sm font-medium text-gray-700">Date de début</label>
                            <input id="debut_date" type="datetime-local" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="debut_date" value="{{ \Carbon\Carbon::parse($reservation->debut_date)->format('Y-m-d\TH:i') }}" required>
                        </div>

                        <!-- Champ pour la date de fin -->
                        <div class="w-1/2">
                            <label for="fin_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                            <input id="fin_date" type="datetime-local" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="fin_date" value="{{ \Carbon\Carbon::parse($reservation->fin_date)->format('Y-m-d\TH:i') }}" required>
                        </div>
                    </div>

                    <!-- Champ pour le statut -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach (config('enumCalendarStatus.status') as $key => $value)
                                <option value="{{ $key }}" {{ $reservation->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bouton de soumission -->
                    <div>
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Modifier la réservation</button>
                    </div>
                </form>

                <!-- Formulaire de suppression -->
                <form method="POST" action="{{ url('reservation/delete/'.$reservation->id) }}" class="mt-4">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer la réservation</button>
                </form>
                <a href="/carousel/{{$carousel->id}}/reservations" class="block text-center mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Retour aux réservations du manège</a>
                <a href="/dashboard_SA/allreservations" class="block text-center mt-4 bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">Retour à toutes les réservations</a>
            </div>
            <a href="/carousel/view" class="block text-center mt-4 bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">Retour aux manèges</a>
        </div>
    </div>
</div>


@endsection
