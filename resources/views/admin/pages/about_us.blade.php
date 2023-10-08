@extends('layouts.admin.master')
@push('css')
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.page-header', [
            'main_section' => __('backend.dashboard'),
            'section' => __('backend.pages.pages'),
            'page' => __('backend.pages.about_us'),
        ])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">{{ __('backend.pages.about_us') }}</div>
                            <div class="card-body">
                                <form class="custom-form" action="{{ route('admin.pages.about_us.update') }}" method="POST">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label class="form-label">{{ __('backend.content_ar') }}</label>
                                            <textarea name="content_ar" class="summernote">{!! $page?->translate('ar')->content !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label class="form-label">{{ __('backend.content_en') }}</label>
                                            <textarea name="content_en" class="summernote">{!! $page?->translate('en')->content !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <button class="btn btn-success">{{ __('backend.save') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
@endsection


@push('js')
    <script>
        $(document).ready(function() {
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
    </script>
@endpush
