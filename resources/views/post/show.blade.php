@extends('layouts.app')

@section('title', $post->title)

@section('head')
    @vite('resources/css/blog/show.css')
@endsection

@section('content')
    <div class="text-center">
        <h1>@yield('title')</h1>
        <p class="text-muted">modifié {{Carbon\Carbon::parse($post->updated_at)->ago()}}</p>
    </div>
    <div class="row">
        @if($post->image !== null)
            <div class="text-center">
                <img src="/storage/{{$post->image}}" alt="Photo de l'article" style="max-height: 80%; max-width: 80%;">
            </div>
        @endif
        <p>{{nl2br($post->content)}}</p>
        <p>Catégorie(s) :</p>
        <h5>
            @foreach($post->categories as $category)
                <span class="badge bg-secondary">{{$category->name}}</span>
            @endforeach
        </h5>
    </div>
    <div class="mt-4" x-cloak>
        <h4>{{ $nbComments }} Commentaires</h4>
        <form action="{{ route('post.comment.store', ['slug' => $post->slug, 'post' => $post]) }}" method="post" style="max-width: 50%;">
            @csrf
            <div class="form-group">
                <x-input label="Votre message" type="textarea" name="message" rows="4" required/>
                <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
            </div>
        </form>
        @livewire('comments.comments-list', ['post' => $post])
    </div>

@endsection
