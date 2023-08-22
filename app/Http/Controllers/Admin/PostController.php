<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application as ContactsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|ContactsApplication
    {
        return view('admin.post.index', [
            'posts' => Post::orderBy('created_at', 'desc')->paginate(12)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|ContactsApplication
    {
        return view('admin.post.form', [
            'post' => new Post()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostFormRequest $request): RedirectResponse
    {
        Post::create($request->validated());
        return $this->redirect('créer');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View|Application|Factory|ContactsApplication
    {
        return view('admin.post.form', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostFormRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());
        return $this->redirect('modifier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return $this->redirect('supprimer');
    }

    /**
     * Redirect with a flash message
     */
    private function redirect(string $action): RedirectResponse
    {
        return to_route('admin.post.index')->with('success', 'L\'article a bien été ' . $action);
    }
}
