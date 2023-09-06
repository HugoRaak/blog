<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettez à jour les informations de profil et l'adresse mail de votre compte") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input label="Nom" name="name" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name"/>
        </div>

        <div>
            <x-input label="Email" name="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autofocus autocomplete="username"/>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Votre adresse mail n\'est pas vérifié') }}

                        <button form="send-verification" class="btn btn-info">
                            {{ __('Renvoyer un email de vérification') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 mt-2 text-center">
            <button type="submit" class="btn btn-secondary">Enregistrer</button>

            @if (session('status') === 'profile-updated')
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
