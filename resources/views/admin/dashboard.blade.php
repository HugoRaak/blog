@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <h1 class="text-center">@yield('title')</h1>

    <div class="mt-4">
        <div class="row justify-content-center">
            <div class="col-3">
                <x-widget :nb="$nbUsers" name="Utilisateurs" :url="route('admin.user.index')"/>
            </div>
            <div class="col-3">
                <x-widget :nb="$nbReports" name="Signalements" :url="route('admin.report.index')"/>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-3">
                <x-widget :nb="$nbCategories" name="Catégories" :url="route('admin.category.index')"/>
            </div>
            <div class="col-3">
                <x-widget :nb="$nbPosts" name="Articles" :url="route('admin.post.index')"/>
            </div>
        </div>
    </div>
@endsection
