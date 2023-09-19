<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Contracts\Foundation\Application as ContactsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public Comment|Reply $comment;
    public Post $post;
    public bool $edit = false;

    public function mount(): void
    {
        if ($this->comment instanceof Reply) {
            $this->comment->load('comment');
        }
    }

    public function startEdit(): void
    {
        $this->edit = true;
    }

    #[On('update.{comment.id}')]
    public function cancelEdit(string $type): void
    {
        $this->edit = false;
        if (get_class($this->comment) === $type) {
            $this->dispatch('endUpdate', message: 'Le commentaire a bien été modifié')->self();
        }
    }

    public function render(): View|Application|Factory|ContactsApplication
    {
        return view('livewire.comments.show', [
            'commentId' => $this->comment instanceof Reply ? $this->comment->comment?->id : $this->comment->id,
        ]);
    }
}
