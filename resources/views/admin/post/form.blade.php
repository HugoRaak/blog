@extends('admin.base')

@section('title', $post->exists ? 'Modifier l\'article' : 'Créer un article')

@section('content')
    <h1 class="text-center">@yield('title')</h1>

    <form action="{{$post->exists ? route('admin.post.update', $post) : route('admin.post.store')}}" method="post">
        @method($post->exists ? 'patch' : 'post')
        @csrf
        <x-input label="Titre" type="text" name="title" :value="$post->title"></x-input>
        <x-input label="Lien" type="text" name="slug" :value="$post->slug"></x-input>
        <x-input label="Contenu" type="textarea" name="content" :value="$post->content" rows="6"></x-input>
        <button type="submit" class="btn btn-success">{{$post->exists ? 'Modifier' : 'Créer'}}</button>
    </form>

@endsection
