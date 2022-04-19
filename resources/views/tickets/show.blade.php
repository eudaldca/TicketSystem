@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.tickets') }}</div>
                    <div class="card-body">
                        <table class="table table-striped" id="tickets-dt">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('messages.issuer') }}</th>
                                <th scope="col">{{ __('messages.title') }}</th>
                                <th scope="col">{{ __('messages.priority') }}</th>
                                <th scope="col">{{ __('messages.assignee') }}</th>
                                <th scope="col">{{ __('messages.category') }}</th>
                                <th scope="col">{{ __('messages.status') }}</th>
                                <th scope="col">{{ __('messages.created') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td>Loading...</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('extra-js')
    @parent
    <script>
        window.addEventListener('load', function () {
            $('#tickets-dt').dataTable({
                "ajax": {
                    "url": "{{ route('datatables.tickets') }}",
                },
                "data": [

                ]
            });
        });
    </script>
@stop
