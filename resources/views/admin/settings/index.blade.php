@extends('layouts.admin.master')
@push('css')
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.page-header', [
            'main_section' => __('backend.dashboard'),
            'section' => __('backend.general_settings'),
            'page' => __('backend.general_settings'),
        ])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">{{ __('backend.general_settings') }}</div>
                            <div class="card-body">
                                <form class="custom-form" action="{{ route('admin.settings.update') }}" method="POST">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">{{ __('general.whatsapp_number') }}</label>
                                            <input class="form-control" type="text" name="whatsapp_number"
                                                value="{{ getSetting('whatsapp_number') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">{{ __('general.terms_file') }}</label>
                                            <input class="form-control" type="file" name="terms_file">
                                            @if (getSetting('terms_file'))
                                                <small>{{ __('general.uploaded_file') }}:
                                                    {{ getSetting('terms_file') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 d-flex">
                                        <label class="form-label">{{ __('general.invoice_system_status') }}</label>
                                        &nbsp;&nbsp;
                                        <div class="custom-control custom-switch text-center">
                                            <input type="checkbox" class="custom-control-input"
                                                id="invoice_system_activated" name="invoice_system_activated"
                                                @checked(getSetting('invoice_system_activated') == 'on')>
                                            <label class="custom-control-label" for="invoice_system_activated"></label>
                                        </div>
                                    </div>
                            </div>
                            </form>
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


@push(' js')
@endpush
