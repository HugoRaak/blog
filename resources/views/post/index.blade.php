@extends('layouts.app')

@section('title', 'Les posts')

@section('head')
    @vite('resources/css/blog/index.css')
@endsection

@section('content')
    <h1 class="text-center">@yield('title')</h1>

    <div class="row justify-content-between mt-3 mb-4">
        <div class="col-10">
            <form class="d-flex gap-2" action="" method="get">
                <input class="form-control" name="title" placeholder="@if(!$title) Mots clefs... @endif" @if($title) value="{{ $title }}" @endif>
                <button class="btn btn-primary d-flex"><i
                        class="fa-solid fa-magnifying-glass fa-xs icon-left icon-search"></i>Recherche
                </button>
            </form>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-primary toogleSidebar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                @if($categorySearch) {{ $categorySearch }} @else Catégories @endif<i class="fa-solid fa-bars fa-xl icon-right"></i>
            </button>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header bg-info text-center">
            <h5 id="offcanvasRightLabel">Catégories</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <ul class="list-group">
            <a class="text-dark text-decoration-none" href="{{ route('post.index', ['category' => 'all']) }}">
                <li class="list-group-item category-all">
                    <div class="category">
                        Toutes catégories
                    </div>
                </li>
            </a>
            @foreach($categories as $category)
                <a class="text-dark text-decoration-none" href="{{ route('post.index', ['category' => $category->slug]) }}">
                    <li class="list-group-item">
                        <div class="category">
                            {{ $category->name }}
                        </div>
                    </li>
                </a>
            @endforeach
        </ul>
    </div>

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
