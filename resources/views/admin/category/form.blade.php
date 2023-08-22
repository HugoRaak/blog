@extends('admin.base')

@section('title', $category->exists ? 'Modifier la catégorie' : 'Créer une catégorie')

@section('content')
    <h1 class="text-center">@yield('title')</h1>

    <form action="{{$category->exists ? route('admin.category.update', $category) : route('admin.category.store')}}" method="post">
        @method($category->exists ? 'patch' : 'post')
        @csrf
        <div class="form-group">
            <x-input label="Nom" type="text" name="name" :value="$category->name"></x-input>
            <x-input label="Lien" type="text" name="slug" :value="$category->slug"></x-input>
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-4">{{$category->exists ? 'Modifier' : 'Créer'}}</button>
            </div>
        </div>
    </form>

@endsection
