@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.tickets') }}</div>
                    <div class="card-body">
                        <table class="table table-striped ">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('messages.issuer') }}</th>
                                <th scope="col">{{ __('messages.status') }}</th>
                                <th scope="col">{{ __('messages.title') }}</th>
                                <th scope="col">{{ __('messages.priority') }}</th>
                                <th scope="col">{{ __('messages.assignee') }}</th>
                                <th scope="col">{{ __('messages.category') }}</th>
                                <th scope="col">{{ __('messages.created') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->issuer->full_name }}</td>
                                <td>{{ __('messages.status.' . $ticket->status) }}</td>
                                <td>{{ $ticket->title }}</td>
                                <td>{{ __('messages.priority.' . $ticket->priority) }}</td>
                                <td>{{ $ticket->assignee->full_name }}</td>
                                <td>{{ $ticket->category->name ?? "" }}</td>
                                <td>{{ $ticket->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
