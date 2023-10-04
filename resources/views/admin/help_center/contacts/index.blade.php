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
            'section' => __('backend.help_center'),
            'page' => __('backend.contact_reqeusts'),
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
                                            data-is-create="1" data-form-action="{{ route('admin.help_center.subjects.store') }}">
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
                                            <th>{{ __('general.subject') }}</th>
                                            <th>{{ __('general.user') }}</th>
                                            <th>{{ __('backend.ams') }}</th>
                                            <th>{{ __('general.description') }}</th>
                                            <th>{{ __('backend.created_at') }}</th>
                                            <th>{{ __('backend.action') }}</th>
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
    @include('admin.help_center.contacts.show-modal')
@endsection


@push('js')
    <!-- DataTables -->

    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script sync src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>



    <script>
        var table_data_url = "{{ route('admin.help_center.contacts.table_data') }}";
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
                    [3, 'desc']
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
                    data: 'subject',
                    name: 'subject',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'user',
                    name: 'user',
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
                    data: 'details',
                    name: 'details',
                    searchable: true,
                    orderable: true,
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
            $(document).on('click', '[data-toggle="modal"][data-target="#show-modal"]', function(e) {
                $('#create-edit-modal .modal-title').text("{{ __('backend.subject_edit') }}");
                $('input[name="subject"]').val($(this).data('subject'));
                $('textarea[name="details"]').text($(this).data('details'));
            });
        });
    </script>
@endpush
