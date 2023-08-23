@extends('base')

@section('title', 'Se connecter')

@section('content')
    <h1 class="text-center">@yield('title')</h1>

    @include('shared.flash')

    <form action="{{route('login')}}" method="post">
        @csrf
        <x-input type="email" name="email"></x-input>
        <x-input label="Mot de passe" type="password" name="password"></x-input>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">Se connecter</button>
        </div>
    </form>
@endsection
