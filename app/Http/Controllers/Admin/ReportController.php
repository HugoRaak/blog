<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Report;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ContactsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ReportController extends Controller
{
    public function index(): View|Application|Factory|ContactsApplication
    {
        return view('admin.report.index', [
           'reports' => Report::orderByDesc('created_at')
               ->with(['user:id,name', 'reportable' => function (MorphTo $morphTo) {
                   $morphTo->morphWith([
                       Reply::class => ['user:id,name'],
                       Comment::class => ['user:id,name'],
                   ]);
               }])
               ->paginate(12)
        ]);
    }

    public function show(Report $report): View|Application|Factory|ContactsApplication
    {
        return view('admin.report.show', [
            'report' => $report->load(['user', 'reportable' => function (MorphTo $morphTo) {
                    $morphTo->morphWith([
                        Reply::class => ['user', 'comment', 'comment.post:id,title', 'comment.user'],
                        Comment::class => ['user', 'post:id,title'],
                    ]);
            }])
        ]);
    }

    public function destroy(Report $report): RedirectResponse
    {
        $report->delete();
        return back()->with('success', 'Le signalement a bien été supprimé');
    }
}
