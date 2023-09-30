@extends('layouts.admin.master')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.page-header', [
            'main_section' => __('backend.dashboard'),
            'section' => __('backend.users.user_and_subscribtions'),
            'page' => __('backend.users.all_users'),
        ])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-8">
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-2">
                                        {{-- <a href="#" data-toggle="modal" data-target="#create-edit-modal"
                                            data-is-create="1" data-form-action="{{ route('admin.coupons.store') }}">
                                            <i class="fa fa-plus"> </i>&nbsp;
                                            {{ __('backend.new') }}
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('backend.name') }}</th>
                                            <th>{{ __('backend.ams') }}</th>
                                            <th>{{ __('backend.phone') }}</th>
                                            <th>{{ __('backend.subscription_status') }}</th>
                                            <th>{{ __('backend.current_club') }}</th>
                                            @if (request()->has('view_subscriptions'))
                                                <th>{{ __('general.subscribtion_type') }}</th>
                                            @endif
                                            <th>{{ __('backend.created_at') }}</th>
                                            @if (request()->has('view_subscriptions'))
                                                <th>{{ __('backend.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.users.create-edit-modal')
    @include('admin.users.confirm-vin-modal')
@endsection


@push('js')
    <!-- DataTables -->

    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script sync src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>



    <script>
        var is_subscribtions_page = "{{ request()->has('view_subscriptions') }}";
        var table_data_url = is_subscribtions_page ?
            "{{ route('admin.users.table_data', ['view_subscriptions' => true]) }}" :
            "{{ route('admin.users.table_data') }}";
    </script>
    {{-- DatatTable --}}
    <script>
        /**
         * render Datatable
         */
        function renderDataTable() {
            $('#myTable').DataTable({
                language: language,
                processing: true,
                order: [
                    [5, 'desc']
                ],
                serverSide: true,
                ajax: table_data_url,
                columns: is_subscribtions_page ? getTableColumnsForSubscribers() : getTableColumnsForUsers(),
                "autoWidth": false,
                "responsive": true,
            });
        }

        function getTableColumnsForUsers() {
            return [{
                    data: 'name',
                    name: 'name',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'ams',
                    name: 'ams',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'phone',
                    name: 'phone',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'subscription',
                    name: 'subscription',
                    searchable: false,
                    orderable: true,
                },
                {
                    data: 'current_club',
                    name: 'current_club',
                    searchable: false,
                    orderable: true,
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: true,
                    orderable: true,
                },
            ];
        }

        function getTableColumnsForSubscribers() {
            return [{
                    data: 'name',
                    name: 'name',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'ams',
                    name: 'ams',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'phone',
                    name: 'phone',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'subscription',
                    name: 'subscription',
                    searchable: false,
                    orderable: true,
                },
                {
                    data: 'current_club',
                    name: 'current_club',
                    searchable: false,
                    orderable: true,
                },
                {
                    data: 'subscribtion_type',
                    name: 'subscribtion_type',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                },
            ];
        }
        $(document).ready(function() {
            renderDataTable();
            // Use the event delegation approach to handle the click event
            $(document).on('click', '[data-toggle="modal"][data-target="#create-edit-modal"]', function(e) {
                var is_create = $(this).data('is-create');
                var form_action = $(this).data('form-action');
                var form_method = is_create === 1 ? 'POST' : 'PUT';
                $('#create-edit-modal form').attr('action', form_action);
                $('#create-edit-modal form input[name="_method"]').val(form_method);
                if (is_create === 1) {
                    $('#create-edit-modal .modal-title').text("{{ __('backend.offers.add_new') }}");
                    $('button[type="reset"]').click();
                } else {
                    // $('#create-edit-modal .modal-title').text("{{ __('backend.offers.edit') }}" + $(this)
                    //     .data('name-' + "{{ app()->getLocale() }}"));
                    $('input[name="current_vin"]').val($(this).data('vin'));
                    $('input[name="subscribtion_id_to_confirm"]').val($(this).data('subscribtion-id'));
                    $('input[name="current_club"]').val($(this).data('club-name'));
                    $('input[name="subscribtion_date"]').val($(this).data('subscrobtion-date'));
                    $('input[name="paid_amount"]').val($(this).data('paid-amount'));
                    $('#file-to-view').prop('href', $(this).data('file-view'));
                    $('#file-to-download').prop('href', $(this).data('file-download'));
                }
            });
        });


        $(document).on('click', '#confrim-vin-btn', function() {
            $('#create-edit-modal').modal('hide');
            $('#confirm-vin-modal').modal('show');
            $('#confirm-vin-modal input[name="subscribtion_id"]').val($('#create-edit-modal input[name="subscribtion_id_to_confirm"]').val());
            $('#confirm-vin-modal input[name="vin"]').val($('#create-edit-modal input[name="current_vin"]').val());
        });
    </script>
@endpush
