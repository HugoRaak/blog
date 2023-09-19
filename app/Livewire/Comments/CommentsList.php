<?php

namespace App\Livewire\Comments;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application as ContactsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CommentsList extends Component
{
    public Post $post;
    public Collection $comments;
    public int $offset = 0;
    public int $commentsToLoad;
    private int $perLoad = 10;
    public int $replyId = -1;
    /**
     * @var int[]
     */
    public array $repliesToShow = [];

    public function mount(): void
    {
        $this->comments = new Collection();
        $this->commentsToLoad = $this->post->comments()->count();
    }

    public function loadComments(): void
    {
        if ($this->commentsToLoad <= 0) {
            return;
        }
        $this->comments->push(
            ...$this->post->comments()
            ->with(['user', 'replies'])
            ->orderByDesc('created_at')
            ->offset($this->offset)
            ->limit($this->perLoad)
            ->get()
        );
        $this->commentsToLoad -= $this->perLoad;
        if ($this->commentsToLoad > 0) {
            $this->offset += $this->perLoad;
        }
    }

    /**
     * @return RedirectResponse|void
     */
    public function startReply(int $id)
    {
        if (Auth::check()) {
            $this->replyId = $id;
        } else {
            return redirect()->to(route('login'));
        }
    }

    public function cancelReply(): void
    {
        $this->replyId = -1;
    }

    public function showReplies(int $id): void
    {
        if (in_array($id, $this->repliesToShow)) {
            unset($this->repliesToShow[array_search($id, $this->repliesToShow)]);
        } else {
            $this->repliesToShow[] = $id;
        }
    }

    public function render(): View|Application|Factory|ContactsApplication
    {
        return view('livewire.comments.comments-list');
    }
}
