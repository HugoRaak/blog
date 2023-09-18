<div>
    @if(!$comments->isEmpty())
        <hr>
    @endif
    <div class="mt-2 comments" wire:loading.delay.class="opacity-50" wire:target="loadComments">
        @foreach($comments as $comment)
            <div id="c{{$comment->id}}">
                @livewire('comments.show', ['comment' => $comment, 'post' => $post, key($comment->id)])
                @if($loop->last) <br> @endif
                @if(!$comment->replies->isEmpty())
                    <div class="show-replies">
                        <div class="icon-replies text-primary">
                            @if(in_array($comment->id, $repliesToShow))
                                <i class="fa-solid fa-caret-up fa-xs"></i>
                            @else
                                <i class="fa-solid fa-caret-down fa-xs"></i>
                            @endif
                        </div>
                        <p wire:click="showReplies({{ $comment->id }})" class="reply-display text-primary">{{ $comment->replies->count() }} réponses</p>
                    </div>
                    <div wire:loading.delay.class="opacity-50 loader" wire:target="showReplies({{ $comment->id }})"></div>
                @endif
                <div class="replies">
                    @if(in_array($comment->id, $repliesToShow))
                        @foreach($comment->replies as $reply)
                            @if(!$loop->first) <br> @endif
                            @livewire('comments.show', ['comment' => $reply, 'post' => $post, key('reply_' . $reply->id)])
                        @endforeach
                    @endif
                    <div wire:loading.delay.class="opacity-50" wire:target="cancelReply">
                        @if($replyId === $comment->id)
                            @livewire('comments.wire-form', ['comment' => $comment, 'post' => $post, key('reply_form_' . $comment->id)])
                        @endif
                    </div>
                    <div wire:loading.delay.class="opacity-50 loader" wire:target="startReply({{ $comment->id }})"></div>
                </div>
                <br>
            </div>
        @endforeach
        <div wire:loading.delay.class="loader" wire:target="loadComments" @if($commentsToLoad > 0) id="last_comment" @endif></div>
    </div>

    <script>
        const lastComment = document.getElementById('last_comment');
        const options = {
            root: null,
            threshold: 1,
            rootMargin: '0px'
        }
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    @this.loadComments()
                }
            });
        });
        observer.observe(lastComment)
    </script>
</div>
