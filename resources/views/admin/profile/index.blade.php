@extends('layouts.admin.master')
@push('css')
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.page-header', [
            'main_section' => __('backend.dashboard'),
            'section' => __('backend.profile'),
            'page' => __('backend.profile'),
        ])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">{{ __('backend.profile') }}</div>
                            <div class="card-body">
                                <form class="custom-form" action="{{ route('admin.profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <div class="card-body box-profile">
                                                <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle"
                                                        src="{{ getImageUrl($auth_admin?->avatar ?? '') }}"
                                                        id="profile-img">
                                                </div>
                                                <h3 class="profile-username text-center">{{ $auth_admin->name }}</h3>
                                                <p class="text-muted text-center">{{ $auth_admin->email }}</p>
                                                <p class="text-muted text-center">{{ $auth_admin->phone }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label class="form-label">{{ __('backend.name') }}</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ $auth_admin->name }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label class="form-label">{{ __('backend.email') }}</label>
                                            <input class="form-control" type="text" name="email"
                                                value="{{ $auth_admin->email }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label class="form-label">{{ __('backend.phone') }}</label>
                                            <input class="form-control" type="text" name="phone"
                                                value="{{ $auth_admin->phone }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label class="form-label">{{ __('backend.photo') }}</label>
                                            <input class="form-control" type="file" name="avatar_file" id="avatar">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <button class="btn btn-success"
                                                type="submit">{{ __('backend.save') }}</button>
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


@push('js')
    <script>
        $('#avatar').change(function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                $('#profile-img').prop('src', reader.result);
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
