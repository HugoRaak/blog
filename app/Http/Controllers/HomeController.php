<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function __invoke(): Application|Factory|View|ContractsApplication
    {
        return view('home', [
            'posts' => Post::orderByDesc('created_at')->limit(4)->get()
        ]);
    }
}
