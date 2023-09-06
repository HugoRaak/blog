<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Changer mot de passe') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Veillez à ce que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-password label="Mot de passe actuel" name="current_password" class="mt-1 block w-full" required autofocus autocomplete="current-password"/>
        </div>

        <div>
            <x-input-password label="Nouveau mot de passe" name="password" class="mt-1 block w-full" required autofocus autocomplete="new-password"/>
        </div>

        <div>
            <x-input-password label="Confirmer mot de passe" name="password_confirmation" class="mt-1 block w-full" required autofocus autocomplete="new-password"/>
        </div>

        <div class="flex items-center gap-4 text-center mt-2">
            <button type="submit" class="btn btn-secondary">Enregistrer</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Sauvegardé.') }}</p>
            @endif
        </div>
    </form>
</section>
