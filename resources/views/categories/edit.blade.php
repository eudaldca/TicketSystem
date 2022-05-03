@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('messages.categories.edit') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('categories.update', ['category' => $category->id]) }}" >
                            @csrf
                            @method('patch')
                            <div class="mb-3">
                                <label for="nameInput" class="form-label">{{ __('messages.category.name') }}</label>
                                <input type="text" class="form-control" id="nameInput" name="name"
                                       value="{{ $category->name }}">
                                <button type="submit" class="btn btn-success">{{ __('messages.category.update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
