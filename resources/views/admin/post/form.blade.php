@extends('layouts.admin')

@section('title', $post->exists ? 'Modifier l\'article' : 'Créer un article')

@section('head')
    @vite(['resources/css/components/previewImage.css', 'resources/js/utils/previewImage.js'])
@endsection

@section('content')
    <h1 class="text-center">@yield('title')</h1>
    <form action="{{$post->exists ? route('admin.post.update', $post) : route('admin.post.store')}}" method="post" enctype="multipart/form-data">
        @method($post->exists ? 'patch' : 'post')
        @csrf
        <div class="form-group">
            <div class="row row justify-content-between">
                <div class="col-7">
                    <x-input label="Titre" name="title" :value="$post->title"/>
                    <x-input label="Lien" name="slug" :value="$post->slug"/>
                </div>
                <div class="col-4 picture-form">
                    <label for="image" class="picture-label">
                        <img src="@if($post->image) /storage/{{ $post->image }} @else /storage/images/posts/default.png @endif"
                             alt="aperçu de l'image" id="imgPreview" style="max-height: 150px; max-width: 400px;">
                        <input type="file" name="image" id="image" class="picture-input" accept="image/*">
                        <span class="change-picture-text">Changer l'image</span>
                    </label>
                    @error('image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <x-input label="Contenu" type="textarea" name="content" :value="$post->content" rows="6"/>
            <x-select label="Catégories" name="categories" :options="$categories" :value="$post->categories()->pluck('id')" multiple/>
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-4">{{$post->exists ? 'Modifier' : 'Créer'}}</button>
            </div>
        </div>
    </form>

@endsection
