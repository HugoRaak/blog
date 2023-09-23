@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <h1 class="text-center">@yield('title')</h1>
    <div class="d-flex flex-column justify-content-center align-items-center mt-4">
        <x-widget :nb="$nbUsers" name="utilisateurs" :url="route('admin.user.index')"/>
        <x-widget :nb="$nbPosts" name="articles" :url="route('admin.post.index')"/>
        <x-widget :nb="$nbCategories" name="catégories" :url="route('admin.category.index')"/>
    </div>
@endsection
