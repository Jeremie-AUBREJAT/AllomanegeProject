<x-guest-layout>
    @if (session('error'))
        <div class="alert alert-danger text-red-500 font-semibold">
            {{ session('error') }}
        </div>
    @endif
    <form id="registrationForm" method="POST" action="{{ route('register') }}"
        class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-4">
        @csrf

        <!-- Name -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                placeholder="Entrez votre nom" :value="old('name')" required autofocus autocomplete="name" />
            <span class="text-red-500 text-xs mt-1" id="name-error"></span>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="surname" :value="__('Prénom')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname"
                placeholder="Entrez votre prénom" :value="old('surname')" autocomplete="surname" />
            <span class="text-red-500 text-xs mt-1" id="surname-error"></span>
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Compagny -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="compagny" :value="__('Entreprise')" />
            <x-text-input id="compagny" class="block mt-1 w-full" type="text" name="compagny"
                placeholder="Entrez votre nom d'entreprise" :value="old('compagny')" autocomplete="compagny" />
            <span class="text-red-500 text-xs mt-1" id="compagny-error"></span>
            <x-input-error :messages="$errors->get('compagny')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                placeholder="Entrez votre E-mail" :value="old('email')" required autocomplete="email" />
            <span class="text-red-500 text-xs mt-1" id="email-error"></span>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                placeholder="Entrez votre mot de passe" required autocomplete="new-password" />
            <p class="text-center text-red-500">votre mot de passe doit comporter au minimum 1 majscule, 1 minuscule, 1
                chiffre et 1 caractère spécial</p>
            <span class="text-red-500 text-xs mt-1" id="password-error"></span>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="password_confirmation" :value="__('Confirmez mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" placeholder="Confirmez votre mot de passe" required
                autocomplete="new-password" />
            <span class="text-red-500 text-xs mt-1" id="password_confirmation-error"></span>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Street Number -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="street_number" :value="__('Numéro de rue')" />
            <x-text-input id="street_number" class="block mt-1 w-full" type="text" name="street_number"
                placeholder="Entrez votre numéro de rue" :value="old('street_number')" autocomplete="street_number" />
            <span class="text-red-500 text-xs mt-1" id="street_number-error"></span>
            <x-input-error :messages="$errors->get('street_number')" class="mt-2" />
        </div>

        <!-- Street Name -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="street_name" :value="__('Nom de la rue')" />
            <x-text-input id="street_name" class="block mt-1 w-full" type="text" name="street_name"
                placeholder="Entrez votre nom de rue" :value="old('street_name')" required autocomplete="street_name" />
            <span class="text-red-500 text-xs mt-1" id="street_name-error"></span>
            <x-input-error :messages="$errors->get('street_name')" class="mt-2" />
        </div>

        <!-- Postal Code -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="postal_code" :value="__('Code postal')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                placeholder="Entrez votre code postal" :value="old('postal_code')" required autocomplete="postal_code" />
            <span class="text-red-500 text-xs mt-1" id="postal_code-error"></span>
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <!-- City -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="city" :value="__('Ville')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')"
                placeholder="Entrez votre ville" required autocomplete="city" />
            <span class="text-red-500 text-xs mt-1" id="city-error"></span>
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="country" :value="__('Pays')" />
            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country', 'France')"
                required autocomplete="country" />
            <span class="text-red-500 text-xs mt-1" id="country-error"></span>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="col-span-1 sm:col-span-1">
            <x-input-label for="phone_number" :value="__('Numéro de téléphone')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                placeholder="Entrez votre numéro de téléphone" :value="old('phone_number')" required
                autocomplete="phone_number" />
            <span class="text-red-500 text-xs mt-1" id="phone_number-error"></span>
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Consent -->
        <div class="col-span-1 sm:col-span-2">
            <label for="rgpd_consent" class="flex items-center">
                <input type="checkbox" id="rgpd_consent" name="rgpd_consent"
                    class="form-checkbox h-5 w-5 text-blue-600 rounded-md" required>
                <span class="ml-2 text-md text-gray-700">
                    J'accepte la <a href="politique-de-confidentialité" target="_blank" class="underline">politique
                        de confidentialité</a>.
                </span>
            </label>
            <span class="text-red-500 text-xs mt-1" id="rgpd_consent-error"></span>
            <x-input-error :messages="$errors->get('rgpd_consent')" class="mt-2" />
        </div>

        <!-- Professional Checkbox -->
        <div class="col-span-1 sm:col-span-2">
            <label for="professional" class="flex items-center mb-2">
                <input type="checkbox" id="professional" name="professional"
                    class="form-checkbox h-5 w-5 text-blue-600 rounded-md" {{ old('professional') ? 'checked' : '' }}>
                <span class="ml-2 text-md text-gray-700">Cochez la case si vous êtes professionnel et que vous
                    souhaitez proposer votre ou vos manèges à la location</span>
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="col-span-1 sm:col-span-2 flex items-center justify-end mt-4">
            <a class="underline text-sm font-semibold text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Déjà un compte ?') }}
            </a>

            <x-primary-button id="registerButton" class="ms-4">
                {{ __("S'enregistrer") }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
