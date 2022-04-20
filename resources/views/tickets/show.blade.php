@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.tickets') }}</div>
                    <div class="card-body">
                        <select id="status-select" class="form-select" aria-label="Default select example">
                            <option selected value="-1">All</option>
                            <option value="0">Open</option>
                            <option value="1">Closed</option>
                        </select>
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
            let selectors = ['#status-select'];
            let $ticketsDt = $('#tickets-dt');
            $ticketsDt.dataTable({
                ajax: {
                    url: "{{ route('datatables.tickets') }}",
                    data: function (d) {
                        d.status = $('#open-select').val();
                    },
                },
                serverSide: true,
                processing: true,
                lengthChange: false,
                columns: [
                    {data: 'issuer.full_name', name: 'issuer.full_name'},
                    {data: 'title', name: 'title'},
                    {data: 'priority', name: 'priority'},
                    {data: 'assignee.full_name', name: 'assignee.full_name'},
                    {data: 'category.name', name: 'category.name', defaultContent: ""},
                    {data: 'status', name: 'status'},
                    {data: 'created', name: 'created'},
                ],
            });

            selectors.forEach(selector => {
                $(selector.selector).on('change', () => $ticketsDt.DataTable().ajax.reload(null, false));
            });
        });
    </script>
@stop
