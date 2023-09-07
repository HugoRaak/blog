@extends('base')

@section('title', $post->title)

@section('content')
    <div class="text-center">
        <h1>@yield('title')</h1>
        <p class="text-muted">modifié {{Carbon\Carbon::parse($post->updated_at)->ago()}}</p>
    </div>
    <div class="row">
        <div class="col">
        {{--TODO: picture--}}
        </div>
        <div class="col">
            <p>{{nl2br($post->content)}}</p>
            <ul class="list-group mt-4">
                @foreach($post->categories as $category)
                    <li class="list-group-item">{{$category->name}}</li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
