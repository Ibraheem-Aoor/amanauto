@extends('layout.admin.master')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <div class="content-wrapper">
        @include('admin.partials.page-header', ['page' => 'التقارير'])

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-4 mt-2">
                                        <label for="">نوع التعد</label>
                                        <select name="filter[type]" class="form-control">
                                            <option value="">-- اختر --</option>
                                            @foreach ($types as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                        <label for="">المنطقة</label>
                                        <select name="filter[area]" class="form-control">
                                            <option value="">-- اختر --</option>
                                            @foreach ($areas as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                        <label for="">القطاع</label>
                                        <select name="filter[sector]" class="form-control">
                                            <option value="">-- اختر --</option>

                                            @foreach ($sectors as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                        <label for="">الإجراء</label>
                                        <select name="filter[action]" class="form-control">
                                            <option value="">-- اختر --</option>

                                            @foreach ($actions as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                        <label for="">تاريخ البدء</label>
                                        <input type="date" name="filter[start_date]" class="form-control">
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                        <label for="">تاريخ الانتهاء</label>
                                        <input type="date" name="filter[end_date]" class="form-control">
                                    </div>
                                    <div class="col-sm-12 mt-4 text-center">
                                        <label for="">&nbsp;</label>
                                        <button class="btn btn-success" id="filter-btn"><i
                                                class="fa fa-filter"></i></button>
                                    </div>
                                    <div class="col-sm-12 mt-4 text-right">
                                        <button class="btn btn-primary" onclick="$('#print-form').submit();"><i class="fa fa-print"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('admin.report.print') }}" method="POST" id="print-form">
                                    @csrf
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="master-checkbox"></th>
                                                <th>الشركة</th>
                                                <th>رقم الرخصة</th>
                                                <th>صاحب الترخيص</th>
                                                <th>نوع التعهد</th>
                                                <th>المنطقة</th>
                                                <th>القطاع</th>
                                                <th>بداية التعهد</th>
                                                <th>نهاية التعهد</th>
                                                <th>فترة التعهد</th>
                                                <th>الإجراء المتخذ</th>
                                                <th>تاريخ الإنشاء</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </form>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <!-- /.content -->
@endsection


@push('js')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        var table_data_url = "{{ $table_data_url }}"
    </script>
    <script src="{{ asset('dist/js/custom/report.js') }}"></script>
@endpush
