<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create comments.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Comment $comment)
    {
        // check if user can comment on tickets not issued by them
        if ($comment->ticket->issuer_id !== $user->id
            && !$user->hasPermission('comment.create.all')) {
            return false;
        }

        // check if user can change status on tickets not issued by them
        if ($comment->action !== null && !$user->hasPermission('comment.status.all')) {
            if ($comment->ticket->issuer_id === $user->id) { // if own post
                if (!$user->hasPermission('comment.status.own')) {
                    return false;
                }
            } else { // if not own post and can't status all
                return false;
            }
        }
        return true;
    }
}
