@extends('layouts.admin.master')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.page-header', [
            'main_section' => __('backend.dashboard'),
            'section' => __('backend.cq.common_questions'),
            'page' => __('backend.cq.common_questions'),
        ])
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
                                data-form-action="{{ route('admin.faqs.store') }}">
                                <i class="fa fa-plus"> </i>&nbsp;
                                {{ __('backend.new') }}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>{{ __('backend.question') }}</th>
                                <th>{{ __('backend.answer') }}</th>
                                <th>{{ __('backend.created_at') }}</th>
                                <th>{{ __('backend.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
        <!-- /.content -->
        @include('admin.faqs.create-edit-modal')
    </div>
    <!-- /.content-wrapper -->
@endsection


@push('js')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

    <script>
        var table_data_url = "{{ route('admin.faqs.table_data') }}";
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
            });
        }

        function getTableColumns() {
            return [{
                    data: 'question',
                    name: 'question',
                    searchable: true,
                    orderable: true,
                },
                {
                    data: 'answer',
                    name: 'answer',
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
                    $('#create-edit-modal .modal-title').text(
                        "{{ __('backend.cq.create_new_question') }}");
                    $('#create-edit-modal textarea[name="question_ar"]').text('');
                    $('#create-edit-modal textarea[name="question_en"]').text('');
                    $('#create-edit-modal textarea[name="answer_ar"]').text('');
                    $('#create-edit-modal textarea[name="answer_en"]').text('');
                } else {
                    $('#create-edit-modal .modal-title').text("{{ __('backend.cq.edit_question') }}");
                    $('#create-edit-modal textarea[name="question_ar"]').text($(this).data('question-ar'));
                    $('#create-edit-modal textarea[name="question_en"]').text($(this).data('question-en'));
                    $('#create-edit-modal textarea[name="answer_ar"]').text($(this).data('answer-ar'));
                    $('#create-edit-modal textarea[name="answer_en"]').text($(this).data('answer-en'));
                }
            });
        });
    </script>
@endpush
