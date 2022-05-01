<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Ticket $ticket
     * @return Response|bool
     */
    public function view(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->issuer_id || $user->can('tickets.see.all');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('tickets.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Ticket $ticket
     * @return Response|bool
     */
    public function update(User $user, Ticket $ticket)
    {
        return $user->can('tickets.edit.all')
            || ($user->id === $ticket->issuer_id && $user->can('tickets.edit.own'));
    }
}
