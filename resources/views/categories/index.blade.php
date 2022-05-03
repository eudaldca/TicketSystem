@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('messages.categories') }}</div>

                    <div class="card-body">
                        <a type="submit" href="{{ route('categories.create') }}"
                           class="btn btn-success">{{ __('messages.category.create') }}</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered ">
                                <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col"># of tickets</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->tickets_count }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                               class="text-black"><i
                                                    class="bi bi-pencil-fill"></i></a>
                                            <form
                                                style="display: inline"
                                                action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="transparent"><i
                                                        class="bi bi-trash-fill"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
