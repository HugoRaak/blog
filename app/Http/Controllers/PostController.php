<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchPostRequest;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class PostController extends Controller
{
    public function index(SearchPostRequest $request): Application|Factory|View|ContractsApplication
    {
        $query = Post::orderByDesc('created_at');
        if ($title = $request->validated('title')) {
            $query->where('title', 'like', "%{$title}%");
        }
        return view('post.index', [
           'posts' => $query->paginate(12)
        ]);
    }

    public function show(string $slug, Post $post): Application|Factory|View|ContractsApplication
    {
        return view('post.show', [
            'post' => $post
        ]);
    }
}
