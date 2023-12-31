<div class="card">
    <div class="card-body">
        <div class="card-title text-center">
            @if($post->image !== null)
                <img src="/storage/{{$post->image}}" alt="photo de l'article" style="max-height: 100px;">
            @endif
            <a href="{{route('post.show', ['slug' => $post->slug, 'post' => $post])}}"><h4>{{$post->title}}</h4></a>
        </div>
        <p class="card-text">{{nl2br($post->excerpt($post->content))}}</p>
        <div class="card-footer">
            <p class="text-muted text-center">posté {{Carbon\Carbon::parse($post->created_at)->ago()}}</p>
        </div>
    </div>
</div>
