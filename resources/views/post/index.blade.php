@extends('layouts.app')

@section('title', 'Les posts')

@section('content')
    <h1 class="text-center">@yield('title')</h1>

    <form class="d-flex gap-2 mt-3 mb-4" action="" method="get">
        <input class="form-control w-75" name="title" placeholder="Mots clefs...">
        <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass fa-xs icon-left"></i>Recherche</button>
    </form>

    <div class="row">
        @forelse($posts as $post)
            <div class="col-4 mt-2">
                @include('post.card')
            </div>
        @empty
            <div class="col">
                <p class="text-center"><b>Aucun article ne correspond à votre recherche</b></p>
            </div>
        @endforelse
    </div>

    {{$posts->links()}}
@endsection
