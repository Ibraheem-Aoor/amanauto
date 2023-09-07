@extends('layouts.user.master')

@section('content')
    <!-- --- End End Mobile-->
    <!-- --- Start Main -->
    <main id="Main">
        <section class="culb-sec">
            <div class="container">
                <div class="row customeRows  align-items-center">
                    @foreach ($clubs as $club)
                        <div class="col-sm-4 col-md-6 col-lg-6 customeColumeCards" onclick='window.location.href="{{ route("clubs.show" , $club->getEncryptedId()) }}"'>
                            <div class="bg-bule-card-price" style="background: {{ $club->color }} !important;">
                                <h3>
                                    {{ $club->name }}
                                </h3>
                                <div class="info-card-clubs">
                                    <h6>
                                        {{ __('general.times') }} : <span>{{ $club->times }}</span>
                                    </h6>
                                    <h6>
                                        {{ __('general.duration') }} : <span>{{ $club->duration }}</span>
                                    </h6>
                                </div>
                                <h2>
                                    {{ $club->is_coming_soon ? __('general.soon')  : formatPrice($club->price) }}
                                </h2>
                                <img src="{{ asset('assets/user/img/Group 4962.png') }}" class="shapeCard" alt="">
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    </main>
    <!-- --- End Main -->
@endsection
