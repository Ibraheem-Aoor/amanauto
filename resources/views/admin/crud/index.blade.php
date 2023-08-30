@extends('layout.admin.master')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.page-header', ['page' => $translated_model_name])
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">

                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="modal" data-target="#create-edit-modal" data-is-create="1"
                                data-form-action="{{ route('admin.crud.', ['model' => $model]) }}">
                                <i class="fa fa-plus"> </i>&nbsp;
                                {{ __('custom.new') }}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>اسم</th>
                                <th>تاريخ الإنشاء</th>
                                <th>إجراءات</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
        <!-- /.content -->
        @include('admin.crud.create-edit-modal')
    </div>
    <!-- /.content-wrapper -->
@endsection


@push('js')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

    <script>
        var table_data_url = "{{ route('admin.project-rleated-crud.table_data', ['model' => $model]) }}";
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
                    [1, 'desc']
                ],
                serverSide: true,
                ajax: table_data_url,
                columns: getTableColumns(),
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
                    data: 'created_at',
                    name: 'created_at',
                    searchable: true,
                    orderable: true,
                }, {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                }
            ];
        }
    </script>
    {{-- Modal --}}
    <script>
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
                    $('#create-edit-modal input[name="name"]').val("");
                } else {
                    $('#create-edit-modal input[name="name"]').val($(this).data('name'));
                }
            });
        });
    </script>
@endpush
