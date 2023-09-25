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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ReportController extends Controller
{
    public function index(Request $request): View|Application|Factory|ContactsApplication
    {
        $reports = Report::orderByDesc('created_at');
        if($request->has('user-send')) {
            $reports->where('user_id', $request->input('user-send'));
        }
        if($request->has('user-receive')) {
            $reports->whereHasMorph(
                'reportable',
                [Comment::class, Reply::class],
                fn (Builder $query) => $query->where('user_id', $request->input('user-receive'))
            )->orWhereHasMorph(
                'reportable',
                [User::class],
                fn (Builder $query) => $query->where('id', $request->input('user-receive'))
            );
        }
        return view('admin.report.index', [
           'reports' => $reports
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

    public function do(Report $report): RedirectResponse
    {
        $reportableId = $report->reportable_id;
        $reportableType = $report->reportable_type;
        $report->reportable()->delete();
        Report::where('reportable_id', $reportableId)
            ->where('reportable_type', $reportableType)
            ->delete();
        Report::whereDoesntHave('reportable')->delete();
        return redirect()->route('admin.report.index')->with('success', 'Le signalement a bien été traité');
    }

    public function destroy(Report $report): RedirectResponse|Redirector
    {
        $report->delete();
        return back(302, [], redirect()->route('admin.report.index'))->with('success', 'Le signalement a bien été supprimé');
    }
}
