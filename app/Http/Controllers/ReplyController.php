<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function destroy(Reply $reply): RedirectResponse
    {
        $reply->delete();
        return redirect()->back()->with('success', 'La réponse a bien été supprimé');
    }
}
