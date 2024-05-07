<div>

    <div class="max-w-md mx-auto bg-white rounded-md p-6 shadow-md mt-28 lg:mr-6">
        <form wire:submit.prevent="submitReservation">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="debut" class="block text-md font-semibold text-custom-blue-header">Date de
                        début</label>
                    <input input type="date" id="debut" name="debut" wire:model="debut_date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="fin" class="block text-md font-semibold text-custom-blue-header">Date de
                        fin</label>
                    <input type="date" id="fin" name="fin" wire:model="fin_date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
            <!-- Bouton pour réserver -->
            @if (!$this->reservationEnregistree)
                <!-- Bouton pour réserver -->
                <button type="submit"
                    class="mt-4 bg-indigo-500 text-white font-semibold py-2 px-4 rounded-md shadow-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400">Réserver</button>
                @error('debut_date')
                    <div class="text-red-500">{{ 'Veuillez entrer une date de début' }}</div>
                @enderror
                @error('fin_date')
                    <div class="text-red-500">{{ 'Veuillez entrer une date de fin' }}</div>
                @enderror
            @else
                <!-- Message de confirmation -->
                <div class="mt-4 text-green-500 font-semibold">Votre réservation a été enregistrée.</div>
            @endif
            @if(!empty($erreurReservation))
    <div class="text-red-500">
        {{ $erreurReservation }}
    </div>
@endif
        </form>
    </div>

    <div id="calendar" wire:ignore></div>
</div>
