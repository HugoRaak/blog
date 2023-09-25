<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ContactsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class ReportForm extends Component
{
    public Reply|Comment|User $reportable;
    public ?Post $post = null;

    #[Rule('string|required|between:10,500')]
    /** @phpstan-ignore-next-line */
    public $message = '';

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();
        $this->reportable->reports()->create($this->only('message') + ['user_id' => Auth::user()?->id]);
        if ($this->post) {
            return redirect()->to(route('post.show', [
                'slug' => $this->post->slug,
                'post' => $this->post]))->with('success', 'Votre signalement a été enregistré');
        }
        return redirect()->to('/')->with('success', 'Votre signalement a été enregistré');
    }

    public function render(): View|Application|Factory|ContactsApplication
    {
        return view('livewire.report-form');
    }
}
