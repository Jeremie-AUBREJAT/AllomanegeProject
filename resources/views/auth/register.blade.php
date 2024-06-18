<x-guest-layout>
    @if (session('error'))
        <div class="alert alert-danger text-red-500 font font-semibold">
            {{ session('error') }}
        </div>
    @endif
    <form id="registrationForm" method="POST" action="{{ route('register') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-4">
        @csrf

        <!-- Name -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="surname" :value="__('Prénom')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Compagny -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="compagny" :value="__('Entreprise')" />
            <x-text-input id="compagny" class="block mt-1 w-full" type="text" name="compagny" :value="old('compagny')" autocomplete="compagny" />
            <x-input-error :messages="$errors->get('compagny')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="password_confirmation" :value="__('Confirmez mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Street Number -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="street_number" :value="__('Numéro de rue')" />
            <x-text-input id="street_number" class="block mt-1 w-full" type="text" name="street_number" :value="old('street_number')" autocomplete="street_number" />
            <x-input-error :messages="$errors->get('street_number')" class="mt-2" />
        </div>

        <!-- Street Name -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="street_name" :value="__('Nom de la rue')" />
            <x-text-input id="street_name" class="block mt-1 w-full" type="text" name="street_name" :value="old('street_name')" required autocomplete="street_name" />
            <x-input-error :messages="$errors->get('street_name')" class="mt-2" />
        </div>

        <!-- Postal Code -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="postal_code" :value="__('Code postal')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" required autocomplete="postal_code" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <!-- City -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="city" :value="__('Ville')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autocomplete="city" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="country" :value="__('Pays')" />
            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required autocomplete="country" />
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="phone_number" :value="__('Numéro de téléphone')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autocomplete="phone_number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Consent -->
        <div class="col-span-1 sm:col-span-2">
            <label for="rgpd_consent" class="flex items-center">
                <input type="checkbox" id="rgpd_consent" name="rgpd_consent" class="form-checkbox h-5 w-5 text-blue-600 rounded-md" required>
                <span class="ml-2 text-md text-gray-700">
                    J'accepte la <a href="politique-de-confidentialité" target="_blank" class="underline">politique de confidentialité</a>.
                </span>
            </label>
            <x-input-error :messages="$errors->get('rgpd_consent')" class="mt-2" />
        </div>

        <!-- Professional Checkbox -->
        <div class="col-span-1 sm:col-span-2">
            <label for="professional" class="flex items-center mb-2">
                <input type="checkbox" id="professional" name="professional" class="form-checkbox h-5 w-5 text-blue-600 rounded-md" {{ old('professional') ? 'checked' : '' }}>
                <span class="ml-2 text-md text-gray-700">Cochez la case si vous êtes professionnel et que vous souhaitez louer votre ou vos manèges</span>
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="col-span-1 sm:col-span-2 flex items-center justify-end mt-4">
            <a class="underline text-sm font-semibold text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà un compte ?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __("S'enregistrer") }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
