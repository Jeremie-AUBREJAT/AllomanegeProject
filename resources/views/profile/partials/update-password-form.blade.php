<section>
    <header>
        <h2 class="text-xl font-medium text-gray-900">
            {{ __('Modifier le mot de passe ') }}
        </h2>

        <p class="mt-1 text-lg text-gray-600">
            {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label class="text-xl" for="update_password_current_password" :value="__('Mot de passe actuel')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                <span id="update_password_current_password-error" class="mt-2 text-red-500 font-semibold"></span>
        </div>

        <div>
            <x-input-label class="text-xl" for="update_password_password" :value="__('Nouveau mot de passe')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                <span id="update_password_password-error" class="mt-2 text-red-500 font-semibold"></span>
        </div>

        <div>
            <x-input-label class="text-xl" for="update_password_password_confirmation" :value="__('Confirmez votre nouveau mot de passe')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                <span id="update_password_password_confirmation-error" class="mt-2 text-red-500 font-semibold"></span>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button id="submitBtnPass">{{ __('Enregister') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
