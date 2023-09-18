<div class="row comment"
     x-data="{ isOpen: false, isButtonVisible: false }"
     @mouseenter="isButtonVisible = true"
     @mouseleave="isButtonVisible = false"
     wire:loading.delay.class="opacity-50" wire:target="startEdit">
    <div class="col">
        <p class="mb-1"><b>{{$comment->user->name}}</b></p>
        <div class="date-reply">
            <p class="text-muted">
                {{ \Carbon\Carbon::parse($comment->created_at)->ago() }}
                @if($comment->created_at->isBefore($comment->updated_at)) <i>(Modifié)</i> @endif
            </p>
            <div class="reply-input">
                <i class="fa-solid fa-share fa-flip-horizontal fa-xs respond-icon"></i>
                <p wire:click="$parent.startReply({{ $commentId }})" class="reply-display">Répondre</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="dropdown-btn" :class="(isButtonVisible || isOpen) ? 'visible' : 'invisible'" @click.outside="isOpen = false">
            <button @click="isOpen = !isOpen" class="btn btn-outline-light text-black"><b>&#8942;</b></button>
        </div>
        <div :class="{ 'dropdown-menu': true, 'show': isOpen }" class="dropdown-menu start-50">
            @if(Auth::user()->id === $comment->user->id)
                <a wire:click="startEdit" class="dropdown-item" href="#c{{ $comment->id }}" @click.prevent="true">
                    <i class="fa-solid fa-pen fa-xs icon-dropdown"></i>Modifier
                </a>
            @endif
            <a class="dropdown-item" href="{{ route('post.index') }}">
                <i class="fa-solid fa-flag fa-xs icon-dropdown"></i>Signaler
            </a>
            @if(Auth::user()->isAdmin() || Auth::user()->id === $comment->user->id)
                <a class="dropdown-item" href="{{ route('post.index') }}" onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?')">
                    <i class="fa-solid fa-trash fa-xs icon-dropdown"></i>Supprimer
                </a>
            @endif
        </div>
    </div>
    <p>{!! nl2br(e($comment->message)) !!}</p>
    <div wire:loading.delay.class="opacity-50"
         x-data="{ isUpdating: false }"
         @update="isUpdating = true; setTimeout(() => { isUpdating = false; }, 2500);"
         :class="{ 'opacity-50': isUpdating }">
        @if($edit)
            @livewire('comments.wire-form', ['comment' => $comment, 'post' => $post, 'isEdit' => true, key('edit_form_' . $comment->id . $commentId)])
        @endif
    </div>
</div>
