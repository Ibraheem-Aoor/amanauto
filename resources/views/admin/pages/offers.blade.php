@extends('layouts.admin.master')
@push('css')
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.page-header', [
            'main_section' => __('backend.dashboard'),
            'section' => __('backend.pages.pages'),
            'page' => __('backend.pages.' . $page),
        ])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">{{ __('backend.pages.' . $page) }}</div>
                            <div class="card-body">
                                <form class="custom-form" action="{{ route('admin.pages.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group col-sm-12">
                                                <label class="form-label">{{ __('backend.offers_page.intro_image') }}</label>
                                                <input type="file" class="form-control" name="offers_page_intro_image">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group col-sm-12">
                                                <label class="form-label">{{ __('backend.offers_page.no_offers_text') }}</label>
                                                <input type="text" class="form-control" name="offers_page_no_offers_text" value="{{ @$page_settings['offers_page_no_offers_text'] }}">
                                            </div>
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
    {{-- <script>
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
    </script> --}}
@endpush
