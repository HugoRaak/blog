<div class="card">
    <div class="card-body">
        <div class="card-title">
            <a href="{{route('post.show', ['slug' => $post->slug, 'post' => $post])}}"><h4>{{$post->title}}</h4></a>
        </div>
        <p class="card-text">{{nl2br($post->content)}}</p> {{--TODO: exerpt--}}
        <div class="card-footer">
            <p class="text-muted text-center">posté il y a </p>{{--TODO: timeago--}}
        </div>
    </div>
</div>
