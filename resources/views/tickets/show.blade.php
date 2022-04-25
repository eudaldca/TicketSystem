@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12">
                        <h1>{{ $ticket->title }}</h1>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <h4><b>{{ __('messages.status') }}</b></h4>
                        <p>{{ __("messages.status." . $ticket->status) }}</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <h4><b>{{ __('messages.priority') }}</b></h4>
                        <p>{{ __("messages.priority." . $ticket->priority) }}</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <h4><b>{{ __('messages.assignee') }}</b></h4>
                        <p>{{ $ticket->assignee->full_name ?? "" }}</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <h4><b>{{ __('messages.category') }}</b></h4>
                        <p>{{ $ticket->category->name }}</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <h4><b>{{ __('messages.created') }}</b></h4>
                        <p>{{ $ticket->created_at->toDayDateTimeString() }}</p>
                    </div>
                </div>
            </div>
            <form class="col-12 col-md-4" id="commentForm" action="{{ route('comments.store') }}" method="post">
                @csrf
                <h3>Actions</h3>
                <div class="form-floating">
                    <textarea class="form-control" id="commentBox" placeholder="{{ __('messages.comments') }}"
                              style="height: 100px" name="content"></textarea>
                    <label for="commentBox">{{ __('messages.comments') }}</label>
                </div>
                <div class="comment-buttons">
                    <input type="submit" name="" class="btn btn-primary" value="Comment">
                    @if($ticket->status === App\Models\Ticket::CLOSED)
                        <input type="submit" name="action" value="{{ App\Models\Comment::OPEN }}" class="btn btn-success">
                    @endif
                    @if($ticket->status === App\Models\Ticket::OPEN)
                        <input type="submit" name="{{ App\Models\Comment::CLOSE }}" class="btn btn-danger" value="Close">
                    @endif
                </div>
            </form>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10 card-list">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>{!! __('messages.ticket.created', ['name' => $ticket->issuer->full_name]) !!}</span>
                        <span>{{ $ticket->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="card-body">
                        <p>{{ $ticket->description }}</p>
                    </div>
                </div>

                @foreach($ticket->comments as $comment)
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <span>{!! __('messages.ticket.comment.' . ($comment->action ?? "c"),
                                        ['name' => $comment->user->full_name]) !!}</span>
                            <span>{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="card-body">
                            <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('extra-js')
    @parent
    <script src="{{ asset('js/ticket.js') }}"></script>
@stop
