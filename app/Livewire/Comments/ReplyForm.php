<?php

namespace App\Livewire\Comments;

use App\Models\Post;
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

class ReplyForm extends Component
{
    public Comment $comment;
    public Post $post;

    #[Rule('string|required|min:2')]
    public $message = '';

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();
        $this->comment->replies()->create($this->only('message') + ['user_id' => Auth::user()->id]);
        return redirect()->to(route('post.show', [
            'slug' => $this->post->slug,
            'post' => $this->post]
        ))->with('success', 'Votre réponse a été posté');
    }

    public function render(): View|Application|Factory|ContactsApplication
    {
        return view('livewire.comments.reply-form');
    }
}
