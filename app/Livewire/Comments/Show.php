<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Contracts\Foundation\Application as ContactsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Show extends Component
{
    public Comment|Reply $comment;

    public function mount(): void
    {
        if ($this->comment instanceof Reply) {
            $this->comment->load('comment');
        }
    }

    public function render(): View|Application|Factory|ContactsApplication
    {
        return view('livewire.comments.show');
    }
}
