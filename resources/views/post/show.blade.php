@extends('base')

@section('title', $post->title)

@section('head')
    <link rel="stylesheet" type="text/css" href="{{asset('css/post/show.css')}}"/>
@endsection

@section('content')
    <div class="text-center">
        <h1>@yield('title')</h1>
        <p class="text-muted">modifié {{Carbon\Carbon::parse($post->updated_at)->ago()}}</p>
    </div>
    <div class="row">
        @if($post->image !== null)
            <div class="text-center">
                <img src="/storage/{{$post->image}}" alt="{{$post->title}}" style="max-height: 80%; max-width: 80%;">
            </div>
        @endif
        <p>{{nl2br($post->content)}}</p>
        <p>Catégorie(s) :</p>
        <h5>
            @foreach($post->categories as $category)
                <span class="badge bg-secondary">{{$category->name}}</span>
            @endforeach
        </h5>
    </div>
    <div class="mt-4">
        <h4>{{ $comments->count() }} Commentaires</h4>
        @include('post.comment.form')
        <hr>
        <div class="mt-2">
            @foreach($comments as $comment)
                <div class="row mt-4 comment" id="c{{$comment->id}}">
                    <div class="col">
                        <p class="mb-1"><b>{{$comment->user->name}}</b></p>
                        <div class="row w-50">
                            <div class="col">
                                <p class="text-muted">
                                    {{ \Carbon\Carbon::parse($comment->created_at)->ago() }}
                                    @if($comment->created_at->isBefore($comment->updated_at)) <i>(Modifié)</i> @endif
                                </p>
                            </div>
                            <div class="col reply">
                                    <svg class="mt-2" fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10px" height="10px" viewBox="0 0 27.361 27.361" xml:space="preserve">
                                        <g><path d="M0,12.022l9.328-9.328v4.146h9.326c4.809,0,8.707,3.898,8.707,8.706v9.12c0-4.81-3.898-8.704-8.707-8.704H9.328v5.389 L0,12.022z"/></g>
                                    </svg>
                                <a href="#c{{ $comment->id }}" class="reply-link">Répondre</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="dropdown">
                            <button class="btn btn-outline-light text-black"><b>&#8942;</b></button>
                            <div class="dropdown-menu start-0 w-25">
                                <a class="dropdown-item" href="#">Modifier</a>
                                <a class="dropdown-item" href="#">Signaler</a>
                                <a class="dropdown-item" href="#">Supprimer</a>
                            </div>
                        </div>
                    </div>
                    <p>{{ $comment->message }}</p>
                    <div class="replies"></div>
                </div>
            @endforeach
        </div>
    </div>

{{--    <script>--}}
{{--        const post = {--}}
{{--            id: {{ $post->id }},--}}
{{--            slug: "{{ $post->slug }}",--}}
{{--        };--}}
{{--        const formToken = "{{ $formToken }}";--}}
{{--    </script>--}}
{{--    <script src="{{asset('js/post/show.js')}}"></script>--}}

@endsection
