<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentFormRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application as ContactsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentFormRequest $request, string $slug, Post $post): RedirectResponse
    {
        $post->comments()->create(
            $request->validated() + ['user_id' => Auth::user()->id]
        );
        return back()->with('success', 'Votre commentaire a été posté');
    }

    public function form(string $slug, Post $post): View|Application|Factory|ContactsApplication
    {
        return view('post.comment.reply-form', [
            'post' => $post
        ]);
    }
}
