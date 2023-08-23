<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(): Application|Factory|View|ContractsApplication
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.post.index'))->with('success', 'Vous êtes maintenant connecté');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
            'password' => 'Email ou mot de passe incorrect'
        ]);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return to_route('login')->with('success', 'Vous êtes maintenant déconnecté');
    }
}
