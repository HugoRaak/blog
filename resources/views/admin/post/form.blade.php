@extends('admin.base')

@section('title', $post->exists ? 'Modifier l\'article' : 'Créer un article')

@section('content')
    <h1 class="text-center">@yield('title')</h1>
    <form action="{{$post->exists ? route('admin.post.update', $post) : route('admin.post.store')}}" method="post" enctype="multipart/form-data">
        @method($post->exists ? 'patch' : 'post')
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <x-input label="Titre" name="title" :value="$post->title"/>
                    <x-input label="Lien" name="slug" :value="$post->slug"/>
                </div>
                <div class="col">
                    @if($post->image !== null)
                        <img src="/storage/{{$post->image}}" alt="{{$post->title}}" style="max-height: 100px;"><br>
                    @endif
                    <x-input label="Images" type="file" name="image" accept="image/*"/>
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
