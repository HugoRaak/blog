<?php

namespace App\Http\Controllers;

use App\Events\ContactRequestEvent;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function index(): Application|Factory|View|ContractsApplication
    {
        return view('contact.index');
    }

    public function send(ContactFormRequest $request): RedirectResponse
    {
        event(new ContactRequestEvent($request->validated()));
        return redirect()->back()->with('success', 'Le mail a bien été envoyé');
    }
}
