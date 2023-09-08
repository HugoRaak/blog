@extends('base')

@section('title', 'Me contacter')

@section('content')
    @include('shared.flash')

    <h1 class="text-center">@yield('title')</h1>

    <form action="{{route('contact.send')}}" method="post">
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <x-input label="Prénom" type="text" name="surname"/>
                </div>
                <div class="col">
                    <x-input label="Nom" type="text" name="name"/>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @guest
                        <x-input type="text" name="email"/>
                    @endguest
                    @auth
                        <x-input type="text" name="email" :value="Auth::user()->email"/>
                    @endauth
                </div>
                <div class="col">
                    <x-input label="Sujet" type="text" name="subject"/>
                </div>
            </div>
            <x-input label="Contenu" type="textarea" name="message" rows="6"/>
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-4">Envoyer</button>
            </div>
        </div>
    </form>
@endsection
