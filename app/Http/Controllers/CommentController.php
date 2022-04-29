<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $comment = new Comment($request->all());
        $comment->ticket_id = $request['ticket_id'];
        $comment->user_id = auth()->user()->id;
        $comment->content = $comment->content ?? '';
        $this->authorize('create', $comment);

        $ticket = Ticket::find($comment->ticket_id);
        if ($comment->action != null) {
            $ticket->status = $comment->action;
            $ticket->update();
        }
        $ticket->comments()->save($comment);

        return redirect()->route('tickets.show', compact('ticket'));
    }
}
