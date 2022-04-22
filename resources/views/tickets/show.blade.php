@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.tickets') }}</div>
                    <div class="card-body">
                        Ticket
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('extra-js')
    @parent
@stop
