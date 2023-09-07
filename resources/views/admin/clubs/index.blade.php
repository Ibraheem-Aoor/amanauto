@extends('layouts.admin.master')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.page-header', [
            'main_section' => __('backend.dashboard'),
            'section' => __('backend.clubs.clubs'),
            'page' => __('backend.clubs.clubs'),
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
                                        <a href="#" data-toggle="modal" data-target="#create-edit-modal"
                                            data-is-create="1" data-form-action="{{ route('admin.clubs.store') }}">
                                            <i class="fa fa-plus"> </i>&nbsp;
                                            {{ __('backend.new') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('backend.name') }}</th>
                                            <th>{{ __('backend.price') }}</th>
                                            <th>{{ __('backend.duration') }}</th>
                                            <th>{{ __('backend.times') }}</th>
                                            <th>{{ __('backend.services') }}</th>
                                            <th>{{ __('backend.status') }}</th>
                                            <th>{{ __('general.soon') }}</th>
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
    @include('admin.clubs.create-edit-modal')
@endsection


@push('js')
    <!-- DataTables -->

    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script sync src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script>
        var table_data_url = "{{ route('admin.clubs.table_data') }}";
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
                    [6, 'desc']
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
                    data: 'price',
                    name: 'price',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'duration',
                    name: 'duration',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'times',
                    name: 'times',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'services',
                    name: 'services',
                    searchable: false,
                    orderable: true,
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'is_coming_soon',
                    name: 'is_coming_soon',
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
            $('.select2').select2();


            // Use the event delegation approach to handle the click event
            $(document).on('click', '[data-toggle="modal"][data-target="#create-edit-modal"]', function(e) {
                var is_create = $(this).data('is-create');
                var form_action = $(this).data('form-action');
                var form_method = is_create === 1 ? 'POST' : 'PUT';
                $('#create-edit-modal form').attr('action', form_action);
                $('#create-edit-modal form input[name="_method"]').val(form_method);
                if (is_create === 1) {
                    $('#create-edit-modal .modal-title').text("{{ __('backend.clubs.add_new_club') }}");
                    $('button[type="reset"]').click();
                } else {
                    $('#create-edit-modal .modal-title').text("{{ __('backend.clubs.edit_club') }}");
                    // Populate the input fields
                    $('input[name="name_ar"]').val($(this).data('name_ar'));
                    $('input[name="name_en"]').val($(this).data('name_en'));
                    $('textarea[name="description_ar"]').text($(this).data('description_ar'));
                    $('textarea[name="description_en"]').text($(this).data('description_en'));
                    $('input[name="price"]').val($(this).data('price'));
                    $('input[name="vat"]').val($(this).data('vat'));
                    $('select[name="vat_type"]').val($(this).data('vat_type'));
                    $('input[name="color"]').val($(this).data('color'));
                    $('input[name="times"]').val($(this).data('times'));
                    $('input[name="duration"]').val($(this).data('duration'));
                    $('select[name="duration_type"]').val($(this).data('duration_type'));
                    $('select[name="services[]"]').val($(this).data('services'));
                    $('select[name="services[]"]').trigger(
                        'change'); // Trigger change event to update select2
                }
            });
        });

        function toggleStatus(checkbox) {
            var isChecked = checkbox.prop('checked'); // Use checkbox.checked to get the boolean value
            var id = checkbox.prop('value');
            console.log(isChecked, id);

            // Use jQuery.ajax for the AJAX request
            $.ajax({
                url: "{{ route('admin.clubs.change_status') }}",
                method: "GET",
                data: {
                    status: isChecked == true ? 1 : 0,
                    id: id // Use checkbox.value to get the ID
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error(response.message);
                }
            });
        }

        function toggleSoon(checkbox) {
            var isChecked = checkbox.prop('checked'); // Use checkbox.checked to get the boolean value
            var id = checkbox.prop('value');
            console.log(isChecked, id);

            // Use jQuery.ajax for the AJAX request
            $.ajax({
                url: "{{ route('admin.clubs.change_soon') }}",
                method: "GET",
                data: {
                    status: isChecked == true ? 1 : 0,
                    id: id // Use checkbox.value to get the ID
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error(response.message);
                }
            });
        }
    </script>
@endpush
