<section>
    <header>
        <h2 class="text-xl font-medium text-gray-900">
            {{ __('Informations du compte') }}
        </h2>

        <p class="mt-1 text-lg text-gray-600">
            {{ __("Mettre à jour les informations de votre profil") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
            
            @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-xl font-semibold text-green-600"
            >{{ __('Mot de passe mis à jour') }}</p>
        @endif
        @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xl font-semibold text-green-600"
                >{{ __('Profil mis à jour') }}</p>
            @endif
        <div>
            <x-input-label class="text-xl" for="name" :value="__('Nom :')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label class="text-xl" for="surname" :value="__('Prénom :')" />
            <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full" :value="old('surname', $user->surname)" required autofocus autocomplete="surname" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
        </div>
        <div>
            <x-input-label class="text-xl" for="compagny" :value="__('Entreprise :')" />
            <x-text-input id="compagny" name="compagny" type="text" class="mt-1 block w-full" :value="old('compagny', $user->compagny)" required autofocus autocomplete="compagny" />
            <x-input-error class="mt-2" :messages="$errors->get('compagny')" />
        </div>
        <div>
            <x-input-label class="text-xl" for="street_number" :value="__('Numero de rue :')" />
            <x-text-input id="street_number" name="street_number" type="text" class="mt-1 block w-full" :value="old('street_number', $user->street_number)" required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('street_number')" />
        </div>
        <div>
            <x-input-label class="text-xl" for="street_name" :value="__('Nom de la rue :')" />
            <x-text-input id="street_name" name="street_name" type="text" class="mt-1 block w-full" :value="old('street_name', $user->street_name)" required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('street_name')" />
        </div>
        <div>
            <x-input-label class="text-xl" for="postal_code" :value="__('Code postal :')" />
            <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $user->postal_code)" required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
        </div>
        <div>
            <x-input-label class="text-xl" for="city" :value="__('Ville/Commune :')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)" required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>
        <div>
            <x-input-label class="text-xl" for="country" :value="__('Pays :')" />
            <x-text-input id="city" name="country" type="text" class="mt-1 block w-full" :value="old('country', $user->country)" required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('country')" />
        </div>
        <div>
            <x-input-label class="text-xl" for="phone_number" :value="__('Numéro de téléphone :')" />
            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', $user->phone_number)" required autofocus autocomplete="phone_number" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>
        <div>
            <x-input-label class="text-xl" for="email" :value="__('Email :')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregister') }}</x-primary-button>

            
        </div>
    </form>
</section>
