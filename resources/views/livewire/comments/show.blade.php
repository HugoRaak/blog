<div class="row comment">
    <div class="col">
        <p class="mb-1"><b>{{$comment->user->name}}</b></p>
        <div class="date-reply">
            <p class="text-muted">
                {{ \Carbon\Carbon::parse($comment->created_at)->ago() }}
                @if($comment->created_at->isBefore($comment->updated_at)) <i>(Modifié)</i> @endif
            </p>
            <div class="reply-input">
                <i class="fa-solid fa-share fa-flip-horizontal fa-xs respond-icon"></i>
                <p wire:click="$parent.startReply(@if($comment instanceof \App\Models\Reply) {{ $comment->comment->id }} @else {{ $comment->id }} @endif)" class="reply-display">Répondre</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="dropdown">
            <button class="btn btn-outline-light text-black dropdown-btn"><b>&#8942;</b></button>
            <div class="dropdown-menu start-0 w-25">
                <a class="dropdown-item" href="#">Modifier</a>
                <a class="dropdown-item" href="#">Signaler</a>
                <a class="dropdown-item" href="#">Supprimer</a>
            </div>
        </div>
    </div>
    <p>{!! nl2br(e($comment->message)) !!}</p>
</div>
