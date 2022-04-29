<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('tickets.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Ticket $ticket): View
    {
        $ticket->load(['comments.user', 'issuer', 'assignee']);
        /** @var User $user */
        $user = Auth::user();
        $user->hasPermission('tickets.create');
        $canChangeStatus = $user->hasPermission('comment.status.all')
            || $user->id === $ticket->issuer_id && $user->hasPermission('comment.status.own');
        $canComment = $user->id === $ticket->issuer_id || $user->hasPermission('comment.create.all');
        return view('tickets.show', compact('ticket', 'canChangeStatus', 'canComment'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    public function destroy(Ticket $ticket)
    {
        //
    }

    /**
     * @throws Exception
     */
    public function datatable(Request $request): JsonResponse
    {
        $ticketStatus = $request["status"];
        /** @var User $user */
        $user = Auth::user();
        $model = Ticket::with(['issuer', 'category', 'assignee']);

        if ($ticketStatus >= 0) {
            $model = $model->where('status', "=", $ticketStatus);
        }
        if (!$user->hasPermission('tickets.see.all')) {
            $model = $model->where('issuer_id', "=", $user->id);
        }

        $model = $model->select('tickets.*');
        return Datatables::eloquent($model)
            ->addColumn('created', fn(Ticket $ticket) => $ticket->created_at->diffForHumans())
            ->make();
    }
}
