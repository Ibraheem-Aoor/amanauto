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
                                            <th>{{ __('backend.created_at') }}</th>
                                            {{-- <th>{{ __('backend.action') }}</th> --}}
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
    {{-- @include('admin.users.create-edit-modal') --}}
@endsection


@push('js')
    <!-- DataTables -->

    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script sync src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>



    <script>
        var table_data_url = "{{ route('admin.users.table_data') }}";
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
                columns: getTableColumns(),
                "autoWidth": false,
                "responsive": true,
            });
        }

        function getTableColumns() {
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
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'current_club',
                    name: 'current_club',
                    searchable: true,
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
        $(document).ready(function() {
            renderDataTable();
        });
    </script>
@endpush
