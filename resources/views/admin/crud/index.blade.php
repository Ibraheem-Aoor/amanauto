@extends('layouts.admin.master')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    {{-- Image Style  --}}
    <style>
        #show-info div .row {
            border-bottom: 1px solid lightgray;
        }

        /* img upload */
        .avatar-picture {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 33px;
        }

        .avatar-picture .image-input {
            position: relative;
            display: inline-block;
            /* border-radius: 50%; */
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* for web */
        .avatar-picture .image-input .image-input-wrapper-web {
            border: 3px solid #fff;
            background-image: url("");
            width: 150px;
            height: 150px;
            /* border-radius: 50%; */
            background-repeat: no-repeat;
            background-size: contain !important;
        }

        /* for mobile */
        .avatar-picture .image-input .image-input-wrapper-mobile {
            border: 3px solid #fff;
            background-image: url("");
            width: 80px;
            height: 80px;
            /* border-radius: 50%; */
            background-repeat: no-repeat;
            background-size: contain !important;
        }

        .avatar-picture .image-input .btn {
            height: 24px;
            width: 24px;
            border-radius: 50%;
            cursor: pointer;
            position: absolute;
            left: 3px;
            bottom: -7px;
            background-color: #FFFFFF;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            padding: 0;
            -webkit-filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.16));
            filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.16));
        }

        .avatar-picture .image-input .btn img {
            position: relative;
            top: -2px;
        }

        .avatar-picture .image-input .btn:hover {
            background-color: var(--main-color);
        }

        .avatar-picture .image-input .btn:hover img {
            -webkit-filter: invert(1) brightness(10);
            filter: invert(1) brightness(10);
        }

        .avatar-picture .image-input .btn input {
            width: 0 !important;
            height: 0 !important;
            overflow: hidden;
            opacity: 0;
            display: none;
        }
    </style>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.page-header', [
            'main_section' => __('backend.dashboard'),
            'section' => __('backend.' . $translated_model_name),
            'page' => __('backend.' . $translated_model_name),
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
                                            data-is-create="1"
                                            data-form-action="{{ route('admin.crud.store', ['model' => $model]) }}">
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
                                            <th>{{ __('backend.created_at') }}</th>
                                            <th>{{ __('backend.action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
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
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        var table_data_url = "{{ route('admin.crud.table_data', ['model' => $model]) }}";
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
                    [2, 'desc']
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
                    $('button[type="reset"]').click();
                    $('#create-edit-modal textarea[name="description_ar"]').text(null);
                    $('#create-edit-modal textarea[name="description_en"]').text(null);
                    $('#create-edit-modal .modal-title').text("{{ __('backend.create_new_service') }}");
                    $('.image-input-wrapper-web').css('background-image',
                        'url("{{ asset('dist/img/product-placeholder.webp') }}")');
                    $('.image-input-wrapper-mobile').css('background-image',
                        'url("{{ asset('dist/img/product-placeholder.webp') }}")');
                    $('#create-edit-modal input[type="file"]').val(null);
                } else {
                    $('#create-edit-modal .modal-title').text("{{ __('backend.edit_service') }} : " + $(
                        this).data('name-ar'));
                    $('#create-edit-modal input[name="name_ar"]').val($(this).data('name-ar'));
                    $('#create-edit-modal input[name="name_en"]').val($(this).data('name-en'));
                    $('#create-edit-modal textarea[name="description_ar"]').text($(this).data(
                        'description-ar') ?? null);
                    $('#create-edit-modal textarea[name="description_en"]').text($(this).data(
                        'description-en') ?? null);
                    $('.image-input-wrapper-web').css('background-image', 'url("' + $(this).data(
                            'web-img') +
                        '")');
                    $('.image-input-wrapper-mobile').css('background-image', 'url("' + $(this).data(
                            'mobile-img') +
                        '")');
                }
            });

            // change image and preveiw for web
            $('#uploadButtonWeb').on('click', function() {
                $('#changeImgWeb').click();
            })

            $('#changeImgWeb').change(function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onloadend = function() {
                    $('.image-input-wrapper-web').css('background-image', 'url("' + reader.result +
                        '")');
                }
                if (file) {
                    reader.readAsDataURL(file);
                }
            });

            // ---------------

            // change image and preveiw for web
            $('#uploadButtonMobile').on('click', function() {
                $('#changeImgMobile').click();
            })

            $('#changeImgMobile').change(function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onloadend = function() {
                    $('.image-input-wrapper-mobile').css('background-image', 'url("' + reader.result +
                        '")');
                }
                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
