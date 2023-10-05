@extends('layouts.user.master')
@section('page', __('general.profile'))
@push('css')
    <style>
        input:focus {
            border: 1px solid #1DC1DD !important;
        }
    </style>
@endpush
@section('content')
    <!-- -- Start Main -->
    <main>
        <!-- -- Start Section Profile -->
        <section class="sec-profile">
            <div class="container">
                <div class="menu-cads">
                    <div class="icon-toggles">
                        <span class="bx bx-menu"></span>
                    </div>
                </div>
                <div class="row">
                    @include('user.profile.sidebar')
                    <div class="col-sm-12 col-md-7 col-lg-8 customeRowProfiles">
                        <div class="row">
                            <form class="custom-form" action="{{ route('profile.password.update') }}" method="POST">
                                @csrf
                                <div class="col-sm-12 col-md-7 col-lg-8 customeRowProfiles">
                                    <h4 class="text-primary text-center">{{ __('general.change_password') }}</h4>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <div class="all-input-payment">
                                        <label for="">
                                            {{ __('backend.password_new') }}:
                                        </label>
                                        <input type="password" name="password" />
                                    </div>
                                    <div class="all-input-payment">
                                        <label for="">
                                            {{ __('backend.password_confirmation') }}:
                                        </label>
                                        <input type="password" name="password_confirmation" />
                                    </div>
                                    <div class="but-Auto">
                                        <button type="submit" class="but-Log">{{ __('backend.save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ----- End Section Profile -->
    </main>
    <!-- --- End Main -->
@endsection
