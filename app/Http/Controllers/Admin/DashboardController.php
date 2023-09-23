<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ContactsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(): View|Application|Factory|ContactsApplication
    {
        return view('admin.dashboard', [
            'nbPosts' => Post::count(),
            'nbCategories' => Category::count(),
            'nbUsers' => User::count(),
        ]);
    }
}
