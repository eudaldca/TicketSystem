@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                @if($user->hasPermission('tickets.create'))
                                    <a class="btn btn-success"
                                       href="{{ route('tickets.create') }}">{{ __('messages.ticket.create') }}</a>
                                @endif
                                <a class="btn btn-info"
                                   href="{{ route('tickets.index') }}">{{ __('messages.ticket.show') }}</a>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-12">
                                @if($user->hasPermission('categories.admin'))
                                    <a class="btn btn-info" href="{{ route('categories.index') }}"
                                    >{{ __('messages.categories.admin') }}</a>
                                @endif
                                @if($user->hasPermission('permissions.admin'))
                                    <a class="btn btn-outline-warning" href="{{ route('permissions.download') }}"
                                    >{{ __('messages.permissions.download') }}</a>
                                    <form method="post" action="{{ route('permissions.upload') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="permissionsFile" class="form-label">Permissions file</label>
                                            <input class="form-control" name="permissions" type="file"
                                                   id="permissionsFile" accept=".yaml" required>
                                        </div>
                                        <button class="btn btn-warning" type="submit"
                                        >{{ __('messages.permissions.upload') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
