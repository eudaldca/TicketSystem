<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(StoreCommentRequest $request)
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
