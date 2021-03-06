<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
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

    public function index(): Factory|View|Application
    {
        return view('tickets.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $ticket = new Ticket($request->all());
        $ticket->issuer_id = Auth::getUser()->id;
        $this->authorize('create', $ticket);
        $ticket->save();
        return redirect()->route('tickets.show', compact('ticket'));
    }

    public function show(Ticket $ticket): View
    {
        $ticket->load(['comments.user', 'issuer', 'assignee']);
        $user = Auth::getUser();
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
        $ticketPriority = $request["priority"];
        $user = Auth::getUser();
        $model = Ticket::with(['issuer', 'category', 'assignee']);

        if ($ticketStatus >= 0) {
            $model = $model->where('status', "=", $ticketStatus);
        }
        if ($ticketPriority >= 0) {
            $model = $model->where('priority', "=", $ticketPriority);
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
