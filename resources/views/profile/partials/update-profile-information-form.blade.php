<section>
    @section('head')
        @vite(['resources/css/profile/info.css', 'resources/css/components/previewImage.css', 'resources/js/utils/previewImage.js'])
    @endsection
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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-2 picture-form">
                <label for="image" class="picture-label">
                    <img src="@if($user->picture) /storage/{{ $user->picture }} @else /storage/images/profile/default.png @endif"
                         alt="aperçu de l'image" id="imgPreview">
                    <input type="file" name="picture" id="image" class="picture-input" accept="image/*" style="max-height: 100px;">
                    <span class="change-picture-text">Changer la photo (150x150)</span>
                </label>
                @error('picture')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col">
                <div>
                    <x-input label="Nom" name="name" class="mt-1 block w-full" :value="old('name', $user->name)"
                             required
                             autofocus autocomplete="name"/>
                </div>

                <div>
                    <x-input label="Email" name="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                             required autofocus autocomplete="username"/>

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
            </div>
        </div>

        <div class="flex items-center gap-4 mt-2 text-center">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk fa-xs icon-left"></i>Enregistrer</button>
        </div>
    </form>

</section>
