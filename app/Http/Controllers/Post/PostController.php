<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchPostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Repository\PostRepository;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    public function index(SearchPostRequest $request): Application|Factory|View|ContractsApplication|RedirectResponse
    {
        $parameters = [];
        $title = 'all';
        $category = 'all';
        $query = Post::orderByDesc('created_at');
        if (array_key_exists('title', $request->validated())) {
            $title = $request->validated('title') ?: 'all';
            $parameters['title'] = $title;
            if ($title !== 'all') {
                $query->where('title', 'like', "%{$title}%");
            }
        }
        if ($request->has('category')) {
            $category = $request->input('category') ?: 'all';
            $parameters['category'] = $category;
            if ($category !== 'all') {
                $query->whereHas('categories', function (Builder $query) use ($request) {
                    $query->where('slug', $request->input('category'));
                });
            }
        }

        $redirect = $this->postRepository->redirectQuery($request, $parameters);
        if ($redirect) {
            return $redirect;
        }

        return view('post.index', [
           'posts' => $query->paginate(12),
           'categories' => Category::all(),
           'title' => $title === 'all' ? null : $title,
           'categorySearch' => $category === 'all' ? null : $category,
        ]);
    }

    public function show(string $slug, Post $post): Application|Factory|View|ContractsApplication
    {
        return view('post.show', [
            'post' => $post,
            'nbComments' => $post->comments()->count(),
        ]);
    }
}
