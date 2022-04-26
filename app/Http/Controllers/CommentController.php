<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
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
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment($request->all());
        $this->authorize('create', $comment);
        dd($request->all());
    }
}
