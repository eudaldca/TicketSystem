@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">{{ __('messages.ticket.create') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('tickets.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-8">
                                    <div class="form mb-3">
                                        <h4><b><label for="titleInput">{{ __('messages.title') }}</label></b></h4>
                                        <input type="text" class="form-control" id="titleInput" name="title" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-2">
                                    <h4><b>{{ __('messages.priority') }}</b></h4>
                                    <select class="form-select" aria-label="Priority select" name="priority">
                                        <option value="0">{{ __('messages.priority.0') }}</option>
                                        <option value="1" selected>{{ __('messages.priority.1') }}</option>
                                        <option value="2">{{ __('messages.priority.2') }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-2">
                                    <h4><b>{{ __('messages.category') }}</b></h4>
                                    <select class="form-select" aria-label="Select category" name="category_id">
                                        <option selected value="">{{ __('messages.none') }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="descriptionTextArea">
                                            <h4><b>{{ __('messages.description') }}</b></h4>
                                        </label>
                                        <textarea class="form-control" id="descriptionTextArea" rows="10"
                                                  name="description" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success float-end"
                                    >{{ __('messages.ticket.create') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@stop
