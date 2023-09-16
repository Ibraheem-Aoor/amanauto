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
            'section' => __('backend.offers.offers'),
            'page' => __('backend.offers.offer_companies'),
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
                                            data-is-create="1" data-form-action="{{ route('admin.offer.store') }}">
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
                                            <th>{{ __('backend.name_ar') }}</th>
                                            <th>{{ __('backend.name_en') }}</th>
                                            <th>{{ __('backend.offers.company') }}</th>
                                            <th>{{ __('backend.discount') }}</th>
                                            <th>{{ __('backend.discount_type') }}</th>
                                            <th>{{ __('backend.status') }}</th>
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
    @include('admin.offers.create-edit-modal')
@endsection


@push('js')
    <!-- DataTables -->

    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script sync src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>



    <script>
        var table_data_url = "{{ route('admin.offer.table_data') }}";
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
                    data: 'name_ar',
                    name: 'name_ar',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'name_en',
                    name: 'name_en',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'company',
                    name: 'company',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'discount_value',
                    name: 'discount_value',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'discount_type',
                    name: 'discount_type',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'status',
                    name: 'status',
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
                    $('#create-edit-modal .modal-title').text("{{ __('backend.offers.add_new') }}");
                    $('button[type="reset"]').click();
                } else {
                    $('#create-edit-modal .modal-title').text("{{ __('backend.offers.edit') }}" + $(this)
                        .data('name-' + "{{ app()->getLocale() }}"));
                    $('input[name="name_ar"]').val($(this).data('name-ar'));
                    $('input[name="name_en"]').val($(this).data('name-en'));
                    $('textarea[name="description_ar"]').summernote('code', $(this).data('description-ar'));
                    $('textarea[name="description_en"]').summernote('code', $(this).data('description-en'));
                    $('input[name="discount_value"]').val($(this).data('discount-value'));
                    $('select[name="discount_type"]').val($(this).data('discount-type'));
                    $('select[name="company_id"]').val($(this).data('company'));
                    $('input[name="end_date"]').val($(this).data('end-date'));
                }
            });

            // summernote
            $('.summernote').summernote({
                codeviewFilter: false,
                codeviewIframeFilter: false,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen']],
                ],
            });
        });
        // toggle offer status
        function toggleStatus(checkbox) {
            var isChecked = checkbox.prop('checked'); // Use checkbox.checked to get the boolean value
            var id = checkbox.prop('value');
            console.log(isChecked, id);

            // Use jQuery.ajax for the AJAX request
            $.ajax({
                url: "{{ route('admin.offer.change_status') }}",
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
