<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentFormRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
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
}
