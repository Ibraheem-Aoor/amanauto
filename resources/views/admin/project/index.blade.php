@extends('layout.admin.master')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <div class="content-wrapper">
        @include('admin.partials.page-header', ['page' => __('custom.sidebar.Projects')])

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-8">

                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-2">
                                        <a href="{{ route('admin.project.create') }}">
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
                                            <th>الشركة</th>
                                            <th>رقم الرخصة</th>
                                            <th>صاحب الترخيص</th>
                                            <th>نوع التعهد</th>
                                            <th>القطاع</th>
                                            <th>تاريخ الإنشاء</th>
                                            <th>إجراءات</th>
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
    </div>
    <!-- /.content -->

    {{-- Info Modal --}}
    @include('admin.project.show-modal')
    {{-- End Modal --}}
@endsection


@push('js')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        var table_data_url = "{{ $table_data_url }}"
    </script>
    <script src="{{ asset('dist/js/custom/project.js') }}"></script>
@endpush
