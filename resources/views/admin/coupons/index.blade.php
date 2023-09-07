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
            'section' => __('backend.coupons.coupons'),
            'page' => __('backend.coupons.coupons'),
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
                                            data-is-create="1" data-form-action="{{ route('admin.coupons.store') }}">
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
                                            <th>{{ __('backend.code') }}</th>
                                            <th>{{ __('backend.discount') }}</th>
                                            <th>{{ __('backend.discount_type') }}</th>
                                            <th>{{ __('backend.available_times') }}</th>
                                            <th>{{ __('backend.count_of_usage') }}</th>
                                            <th>{{ __('general.status.status') }}</th>
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
    @include('admin.coupons.create-edit-modal')
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
                    data: 'code',
                    name: 'code',
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
                    data: 'times',
                    name: 'times',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'usages',
                    name: 'usages',
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
                    $('input[name="code"]').val($(this).data('code'));
                    $('input[name="discount_value"]').val($(this).data('discount-value'));
                    $('select[name="discount_type"]').val($(this).data('discount-type'));
                    $('input[name="times"]').val($(this).data('times'));
                    $('input[name="start_date"]').val($(this).data('start-date'));
                    $('input[name="end_date"]').val($(this).data('end-date'));
                }
            });
        });

        function toggleStatus(checkbox) {
            var isChecked = checkbox.prop('checked'); // Use checkbox.checked to get the boolean value
            var id = checkbox.prop('value');
            console.log(isChecked, id);

            // Use jQuery.ajax for the AJAX request
            $.ajax({
                url: "{{ route('admin.coupon.change_status') }}",
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

        function generateCouponCode() {
            const charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            let couponCode = "";

            for (let i = 0; i < 8; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                couponCode += charset.charAt(randomIndex);
            }
            // Format the coupon code with dashes every 4 characters
            const formattedCouponCode = couponCode.match(/.{1,4}/g).join("-");
            $('input[name="code"]').val(formattedCouponCode);
        }
    </script>
@endpush
