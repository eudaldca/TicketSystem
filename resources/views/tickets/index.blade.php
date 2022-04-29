@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.tickets') }}</div>
                    <div class="card-body">
                        <select id="status-select" class="form-select" aria-label="Ticket status filter">
                            <option value="-1">All</option>
                            <option selected value="0">Open</option>
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
        let priorityStrings = [
            "{{ __('messages.priority.0') }}",
            "{{ __('messages.priority.1') }}",
            "{{ __('messages.priority.2') }}",
        ];
        let statusStrings = [
            "{{ __('messages.status.0') }}",
            "{{ __('messages.status.1') }}",
        ];

        function titleRender(data, _, row) {
            return `<a href="/tickets/${row.id}">${data}</a>`;
        }


        window.addEventListener('load', function () {

            let $ticketsDt = $('#tickets-dt');
            let selectors = [
                ['status', '#status-select']
            ];
            $ticketsDt.dataTable({
                ajax: {
                    url: "{{ route('datatables.tickets') }}",
                    data: function (d) {
                        d.status = $('#status-select').val();
                    },
                },
                serverSide: true,
                processing: true,
                lengthChange: false,
                order: [6, 'desc'],
                columns: [
                    {data: 'issuer.full_name', name: 'issuer.full_name'},
                    {data: 'title', name: 'title', render: titleRender},
                    {data: 'priority', name: 'priority', render: data => priorityStrings[data]},
                    {data: 'assignee.full_name', name: 'assignee.full_name', defaultContent: ""},
                    {data: 'category.name', name: 'category.name', defaultContent: ""},
                    {data: 'status', name: 'status', render: data => statusStrings[data]},
                    {data: 'created', name: 'created'},
                ],
            });

            selectors.forEach(selector => {
                $(selector[1]).on('change', () => $ticketsDt.DataTable().ajax.reload(null, false));
            });
        });
    </script>
@stop
