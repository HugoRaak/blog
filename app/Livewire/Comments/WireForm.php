<?php

namespace App\Livewire\Comments;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application as ContactsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class WireForm extends Component
{
    public Comment|Reply $comment;
    public Post $post;
    public bool $isEdit = false;
    public string $label = 'Votre réponse';
    public string $action = 'store';
    public string $cancelAction = '$parent.cancelReply';

    #[Rule('string|required|min:2')]
    public $message = '';

    public function mount()
    {
        if($this->isEdit) {
            $this->label = 'Votre commentaire';
            $this->action = 'save';
            $this->cancelAction = '$parent.cancelEdit';
            $this->message = $this->comment->message;
        }
    }

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();
        $this->comment->replies()->create($this->only('message') + ['user_id' => Auth::user()->id]);
        return redirect()->to(route('post.show', [
            'slug' => $this->post->slug,
            'post' => $this->post]
        ))->with('success', 'Votre réponse a été posté');
    }

    public function save(): void
    {
        $this->validate();
        $this->comment->update($this->only('message'));
        $this->dispatch('update');
    }

    public function render(): View|Application|Factory|ContactsApplication
    {
        return view('livewire.comments.wire-form');
    }
}
