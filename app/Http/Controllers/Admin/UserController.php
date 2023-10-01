<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ContactsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): View|Application|Factory|ContactsApplication
    {
        return view('admin.user.index', [
            'users' => User::orderByDesc('created_at')->with(['comments', 'replies'])->paginate(12)
        ]);
    }

    public function show(User $user): View|Application|Factory|ContactsApplication
    {
        return view('admin.user.show', [
            'user' => $user,
            'comments' => $user->comments()->with('post:id,title')->get()
                ->push(...$user->replies()->with(['comment', 'comment.user:id,name', 'comment.post:id,title'])->get())
                ->sortByDesc('created_at'),
        ]);
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->delete();
        if (!$request->has('r')) {
            return redirect()->back()->with('success', 'L\'utilisateur a bien été supprimé');
        }
        return redirect()->route('admin.user.index')->with('success', 'L\'utilisateur a bien été supprimé');
    }
}
