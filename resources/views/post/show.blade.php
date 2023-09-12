@extends('base')

@section('title', $post->title)

@section('content')
    <div class="text-center">
        <h1>@yield('title')</h1>
        <p class="text-muted">modifié {{Carbon\Carbon::parse($post->updated_at)->ago()}}</p>
    </div>
    <div class="row">
        @if($post->image !== null)
            <div class="col">
                <img src="/storage/{{$post->image}}" alt="{{$post->title}}" style="max-height: 300px;">
            </div>
        @endif
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
