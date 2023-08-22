@extends('admin.base')

@section('title', $post->exists ? 'Modifier l\'article' : 'Créer un article')

@section('content')
    <h1 class="text-center">@yield('title')</h1>
    <form action="{{$post->exists ? route('admin.post.update', $post) : route('admin.post.store')}}" method="post">
        @method($post->exists ? 'patch' : 'post')
        @csrf
        <div class="form-group">
            <x-input label="Titre" type="text" name="title" :value="$post->title"></x-input>
            <x-input label="Lien" type="text" name="slug" :value="$post->slug"></x-input>
            <x-input label="Contenu" type="textarea" name="content" :value="$post->content" rows="6"></x-input>
            <x-select label="Catégories" name="categories" :options="$categories" :value="$post->categories()->pluck('id')" multiple></x-select>
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-4">{{$post->exists ? 'Modifier' : 'Créer'}}</button>
            </div>
        </div>
    </form>

@endsection
