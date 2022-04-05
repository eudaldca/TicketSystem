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
     */
    public function store(StoreCommentRequest $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommentRequest $request
     * @param Comment $comment
     * @return Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
