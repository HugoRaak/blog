@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <h1 class="text-center">@yield('title')</h1>
    <p>Bienvenue sur le blog ! Sur ce blog vous pourrez trouver différents articles sur plein de sujets différents.
        N'hésitez pas à aller faire un tour sur l'onglet Blog. En attendant voici les derniers articles publiés</p>

    <div class="row">
        @foreach($posts as $post)
            <div class="col">
                @include('post.card')
            </div>
        @endforeach
    </div>
@endsection
