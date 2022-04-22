<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket): View
    {
        $ticket->load(['comments.user', 'issuer', 'assignee']);
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    /**
     * @throws Exception
     */
    public function datatable(Request $request): JsonResponse
    {
        $status = $request["status"];
        $model = Ticket::with(['issuer', 'category', 'assignee']);

        if ($status >= 0) {
            $model = $model->where('status', "=", $status);
        }

        $model = $model->select('tickets.*');
        return Datatables::eloquent($model)
            ->addColumn('created', fn(Ticket $ticket) => $ticket->created_at->diffForHumans())
            ->make();
    }
}
