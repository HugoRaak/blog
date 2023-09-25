@extends('layouts.admin')

@section('title', $user->name)

@section('head')
    @vite('resources/css/admin/show.css')
@endsection

@section('content')
    <h1 class='text-center'>@yield('title')</h1>

    <div class="row mt-4">
        <div class="col-4">
            <img src="@if($user->picture) /storage/{{ $user->picture }} @else /storage/images/profile/default.png @endif"
                 alt="Photo de profile" style="max-height: 150px;">
        </div>
        <div class="col-3">
            <div class="card" style="max-height: 150px;">
                <div class="card-body">
                    <h5 class="card-title text-center">Informations personnelles</h5>
                    <p class="card-text"><b>Nom</b> : {{ $user->name }}</p>
                    <p class="card-text"><b>Email</b> : {{ $user->email }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="height: 150px;">
                <div class="card-body">
                    <h5 class="card-title text-center">Statut et rôle</h5>
                    <div style="margin-top: 30px;">
                        <p class="card-text"><b>Statut :</b> @if($user->email_verified_at) email vérifié {{Carbon\Carbon::parse($user->email_verified_at)->ago()}} @else email non vérifié @endif</p>
                        <p class="card-text"><b>Rôle :</b> {{ $user->role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($comments->first())
        <div class="mt-4 text-center" x-data="{showComments : false}">
            <h4 class="text-center">Commentaires</h4>
            <button class="btn btn-outline-dark mt-4" @click="showComments = true" x-show="!showComments">Voir les commentaires</button>
            <div class="row" x-show="showComments">
                @foreach($comments as $comment)
                    <div class="col-4 mt-2">
                        <div class="card">
                            <div class="card-body">
                                @if($comment instanceof \App\Models\Reply)
                                    <h5 class="card-title text-center">En réponse à
                                        <a href="{{ route('admin.user.show', $comment->comment->user) }}" class="link">
                                            {{ $comment->comment->user->name }}
                                        </a>
                                    </h5>
                                    <p class="card-text opacity-50"><i>{{$comment->comment->message}}</i></p>
                                @else
                                    <h5 class="card-title text-center">Sur l'article {{$comment->post->title}}</h5>
                                @endif
                                <hr>
                                <p class="card-text">{{ $comment->message }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center mt-4"><b>{{ $user->name }} n'a pas encore posté de commentaire</b></p>
    @endif

@endsection
