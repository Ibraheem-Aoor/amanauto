@extends('layout.admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.page-header', ['page' => __('custom.sidebar.Projects')])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        {{-- Start Form --}}
                        <div class="card card-primary">
                            <div class="card-header">
                                @if (isset($project))
                                    <h3 class="card-title">تعديل التعهد</h3>
                                @else
                                    <h3 class="card-title">إضافة تعهد جديد</h3>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" name="create-project" action="#" method="{{ $form_method }}"
                                data-action-url="{{ $form_route }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="no">اسم الشركة</label>
                                                <input required type="text" class="form-control" id="no"
                                                    name="company_name"
                                                    @isset($project) value="{{ $project->company_name }}" @endisset
                                                    placeholder="اسم الشركة">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">رقم الهاتف</label>
                                                <input required type="name" class="form-control" id="name"
                                                    name="phone_number"
                                                    @isset($project) value="{{ $project->phone_number }}" @endisset
                                                    placeholder="05612345678">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">رقم الموبايل</label>
                                                <input required type="text" class="form-control" id=""
                                                    name="mobile_number"
                                                    @isset($project) value="{{ $project->mobile_number }}" @endisset>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="land_no">صاحب الترخيص</label>
                                                <input required type="text" class="form-control" id="owner"
                                                    name="owner"
                                                    @isset($project) value="{{ $project->owner }}" @endisset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="place_number">رقم مكاني</label>
                                                <input required type="text" class="form-control" id="place_number"
                                                    name="place_number"
                                                    @isset($project) value="{{ $project->place_number }}" @endisset>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="license_number">رقم الرخصة</label>
                                                <input required type="text" class="form-control" id="license_number"
                                                    name="license_number"
                                                    @isset($project) value="{{ $project->license_number }}" @endisset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="type_id">نوع التعهد</label>
                                                <select name="type_id" class="form-control" id="type_id">
                                                    <option value="">--{{ __('custom.select') }}--</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}"
                                                            @if (isset($project) && $project->type_id == $type->id) selected @endif>
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="start_date">تاريخ بداية التعهد</label>
                                                <input required type="date" class="form-control" id="start_date"
                                                    name="start_date"
                                                    @isset($project) value="{{ $project->start_date }}" @endisset>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="end_date">تاريخ نهاية التعهد</label>
                                                <input required type="date" class="form-control" id="end_date"
                                                    name="end_date"
                                                    @isset($project) value="{{ $project->end_date }}" @endisset>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="end_date">فترة التعهد (بالأيام)</label>
                                                <input readonly class="form-control"id="date_difference"
                                                    @isset($project) value=""    @endisset>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Board - Sector - Area --}}
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="area_id">المنطقة</label>
                                                <select name="area_id" class="form-control" id="area_id">
                                                    <option value="">--{{ __('custom.select') }}--</option>
                                                    @foreach ($areas as $area)
                                                        <option value="{{ $area->id }}"
                                                            @if (isset($project) && $project->area_id == $area->id) selected @endif>
                                                            {{ $area->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="sector_id">القطاع</label>
                                                <select name="sector_id" class="form-control" id="sector_id">
                                                    <option value="">--{{ __('custom.select') }}--</option>
                                                    @foreach ($sectors as $sector)
                                                        <option value="{{ $sector->id }}"
                                                            @if (isset($project) && $project->sector_id == $sector->id) selected @endif>
                                                            {{ $sector->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="board_id">لجنة</label>
                                                <select name="board_id" class="form-control" id="board_id">
                                                    <option value="">--{{ __('custom.select') }}--</option>
                                                    @foreach ($boards as $board)
                                                        <option value="{{ $board->id }}"
                                                            @if (isset($project) && $project->board_id == $board->id) selected @endif>
                                                            {{ $board->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="action_id">الاجراء المتخذ</label>
                                                <select name="action_id" class="form-control" id="action_id">
                                                    <option value="">--{{ __('custom.select') }}--</option>
                                                    @foreach ($actions as $action)
                                                        <option value="{{ $action->id }}"
                                                            @if (isset($project) && $project->action_id == $action->id) selected @endif>
                                                            {{ $action->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="action_id">ملاحظات</label>
                                                <textarea name="notes" class="form-control">@isset($project){{ $project->notes }}@endisset
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                    <button type="reset" hidden></button>
                                </div>
                        </div>
                        <!-- /.card-body -->

                        </form>
                    </div>
                    {{-- End  Form --}}
                </div>

            </div>
    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('js')
    {{-- project js  --}}
    <script src="{{ asset('dist/js/custom/project.js') }}"></script>
    <script>
        // File: resources/js/custom/project.js

        // Function to calculate the difference between start_date and end_date
        function calculateDateDifference() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const resultInput = document.getElementById(
                'date_difference'); // Assuming there's an input field for displaying the result

            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            // Calculate the difference in milliseconds
            const differenceInMs = endDate - startDate;

            // Convert milliseconds to days
            const differenceInDays = differenceInMs / (1000 * 60 * 60 * 24);

            // Update the result in the input field
            if (differenceInDays) {

                resultInput.value = differenceInDays;
            }
        }

        // Attach the event listener to call the function when the inputs change
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            startDateInput.addEventListener('change', calculateDateDifference);
            endDateInput.addEventListener('change', calculateDateDifference);
        });
    </script>
    @isset($project)
        <script>
            calculateDateDifference();
        </script>
    @endisset
@endpush
