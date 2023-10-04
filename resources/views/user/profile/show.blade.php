@extends('layouts.user.master')
@section('page', __('general.profile'))
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
                        {{-- <div class="row">
                            <div class="col-md-6 text-center mt-5">
                                <h4 class="text-primary">{{ __('backend.name') }}</h4>
                                <h6>{{ $user->name }}</h6>
                            </div>
                            <div class="col-md-6 text-center mt-5">
                                <h4 class="text-primary">{{ __('backend.phone') }}</h4>
                                <h6>{{ $user->phone }}</h6>
                            </div>
                            <div class="col-md-6 text-center mt-5">
                                <h4 class="text-primary">{{ __('backend.ams') }}</h4>
                                <h6>{{ $user->ams }}</h6>
                            </div>
                            <div class="col-md-6 text-center mt-5">
                                <h4 class="text-primary">{{ __('backend.ams') }}</h4>
                                <h6>{{ $user->created_at->format('Y-m-d') }}</h6>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="bg-bule-card-price" style="background: #1ca6c6 !important;">
                                <div class="info-card-clubs">
                                    <h3>
                                        {{ __('general.profile') }}
                                    </h3>
                                    <h6>
                                        {{ __('backend.name') }}: <span>{{ $user->name }}</span>
                                    </h6>
                                    <h6>
                                        {{ __('backend.phone') }}: <span>{{ $user->phone }}</span>
                                    </h6>
                                    <h6>
                                        {{ __('general.amanauto_ams') }}: <span>{{ $user->ams }}</span>
                                    </h6>
                                    {{-- @isset($club)
                                        <h6>
                                            {{ __('general.vin') }} : <span>{{ $club->name }}</span>
                                        </h6>
                                        <h6>
                                            {{ __('general.vin') }} : <span>{{ $user->vin }}</span>
                                        </h6>
                                    @endisset --}}
                                    <h6>
                                        {{ __('general.join_date') }} :
                                        <span>{{ $user->created_at->format('Y-m-d') }}</span>
                                    </h6>
                                </div>
                                <img src="{{ asset('assets/user/img/Group 4993.svg') }}" class="logoCard" alt="">
                                <img src="{{ asset('assets/user/img/Group 4962.png') }}" class="shapeCard" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- ----- End Section Profile -->
    </main>
    <!-- --- End Main -->
@endsection
