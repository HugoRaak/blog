<div class="row comment"
     x-data="{ isOpen: false, isButtonVisible: false, flashMessage: '', report: false }"
     @mouseenter="isButtonVisible = true"
     @mouseleave="isButtonVisible = false"
     wire:loading.delay.class="opacity-50" wire:target="startEdit"
     x-init="@this.on('endUpdate', (message) => {
            flashMessage = message.message; setTimeout(() => {
                flashMessage = '';
            }, 5000);
         });">
    <div x-show="flashMessage" x-text="flashMessage" class="alert alert-success"></div>
    <div class="col">
        <div class="profile">
            <div class=" profile-picture">
                <img src="@if($comment->user->picture) /storage/{{ $comment->user->picture }} @else /storage/images/profile/default.png @endif"
                     alt="Photo de profile">
            </div>
            <div class="profile-info">
                <a class="mb-1 user-link" href="{{ route('profile.show', $comment->user) }}">
                    <b>{{$comment->user->name}}</b>
                </a>
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
        </div>
    </div>
    @auth
        @php($user = Auth::user())
        <div class="col">
            <div class="dropdown-btn" :class="(isButtonVisible || isOpen) ? 'visible' : 'invisible'" @click.outside="isOpen = false">
                <button @click="isOpen = !isOpen" class="btn btn-outline-light text-black"><b>&#8942;</b></button>
            </div>
            <div :class="{ 'show': isOpen }" class="dropdown-menu custom-dropdown-menu start-50">
                @if($user->id === $comment->user->id)
                    <a wire:click="startEdit" class="dropdown-item" href="#c{{ $comment->id }}" @click.prevent="true">
                        <i class="fa-solid fa-pen fa-xs icon-left"></i>Modifier
                    </a>
                @elseif(!$user->authoredReports()->where('reportable_id', $comment->id)->where('reportable_type', get_class($comment))->exists())
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reportModal-{{ $commentId . $comment->id }}">
                        <i class="fa-solid fa-flag fa-xs icon-left"></i>Signaler
                    </button>
                @endif
                @if($user->isAdmin() || $user->id === $comment->user->id)
                    <form action="@if($comment instanceof \App\Models\Reply){{ route('reply.destroy', $comment) }}@else{{ route('comment.destroy', $comment) }}@endif" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer ce commentaire ?')">
                        @csrf
                        @method('delete')
                        <button class="dropdown-item" type="submit"><i class="fa-solid fa-trash fa-xs icon-left"></i>Supprimer</button>
                    </form>
                @endif
            </div>
        </div>
    @endauth
    <p>{!! nl2br(e($comment->message)) !!}</p>

    <div class="modal fade" id="reportModal-{{ $commentId . $comment->id }}" tabindex="-1" aria-labelledby="reportModalLabel-{{ $commentId . $comment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel-{{ $commentId . $comment->id }}">Faire un signalement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('report-form', ['reportable' => $comment, 'post' => $post, key('report_form_' . $comment->id . $commentId)])
                </div>
            </div>
        </div>
    </div>

    <div wire:loading.delay.class="opacity-50"
         x-data="{ isUpdating: false }"
         @update-{{$comment->id}}.dot="isUpdating = true; setTimeout(() => { isUpdating = false; }, 2500);"
         :class="{ 'opacity-50': isUpdating }">
        @if($edit)
            @livewire('comments.wire-form', ['comment' => $comment, 'post' => $post, 'isEdit' => true, key('edit_form_' . $comment->id . $commentId)])
        @endif
    </div>
</div>
