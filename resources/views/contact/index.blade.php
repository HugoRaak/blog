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
                    <x-input label="Prénom" type="text" name="surname"></x-input>
                </div>
                <div class="col">
                    <x-input label="Nom" type="text" name="name"></x-input>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-input type="text" name="email"></x-input>
                </div>
                <div class="col">
                    <x-input label="Sujet" type="text" name="subject"></x-input>
                </div>
            </div>
            <x-input label="Contenu" type="textarea" name="message" rows="6"></x-input>
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-4">Envoyer</button>
            </div>
        </div>
    </form>
@endsection
