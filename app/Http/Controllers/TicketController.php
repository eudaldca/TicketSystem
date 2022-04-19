<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Renderable;
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
        return view('tickets.show');
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
     * @param StoreTicketRequest $request
     * @return Response
     */
    public function store(StoreTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTicketRequest $request
     * @param Ticket $ticket
     * @return Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    /**
     * @throws Exception
     */
    public function datatable()
    {
        $model = Ticket::query();
        return Datatables::of($model)
            ->addColumn('issuer', fn(Ticket $ticket) => $ticket->issuer->full_name)
            ->addColumn('assignee', fn(Ticket $ticket) => $ticket->assignee->full_name)
            ->addColumn('category', fn(Ticket $ticket) => $ticket->category->name ?? "")
            ->addColumn('created', fn(Ticket $ticket) => $ticket->created_at->diffForHumans())
            ->make(true);
    }
}
