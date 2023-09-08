<?php

namespace App\Http\Controllers;

use App\Events\ContactRequestEvent;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactMail;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(): Application|Factory|View|ContractsApplication
    {
        return view('contact.index');
    }

    public function send(ContactFormRequest $request): RedirectResponse
    {
        event(new ContactRequestEvent($request->validated()));
        return back()->with('success', 'Le mail a bien été envoyé');
    }
}
