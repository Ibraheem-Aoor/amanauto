@extends('layouts.user.master')
@section('page', $club->name)
@section('content')
    <!-- --- Start Main -->
    <main id="Main">

        <section class="sec-detalis-info-view">
            <div class="container">
                <div class="content-detalis">
                    <div class="bg-bule-card-price customeWith" style="background: {{ $club->color }} !important;">
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
                            {{ formatPrice($club->price) }}
                        </h2>
                        <img src="{{ asset('assets/user/img/Group 4962.png') }}" class="shapeCard" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- ----Start Content Culbs -->
        <section class="content-culbs">
            <div class="container text-center">
                <h4>
                    {{ $club->name }}
                </h4>
                <p class="tex-center">
                    {{ $club->description }}
                </p>
            </div>
        </section>
        <!-- ----- End Content Culbs -->
        <!-- ---- Start Sevice -->
        <section class="sevice">
            <div class="container">
                <div class="All-Card-Service customeService">
                    <h4>
                        {{ __('general.various_service_secure') }}
                    </h4>
                    <div class="row">
                        @foreach ($club->services as $service)
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="card-service">
                                    <img src="{{ getImageUrl($service->web_img) }}" alt="">
                                    <h5>
                                        {{ $service->name }}
                                    </h5>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    @if (!$club->is_coming_soon)
                        <div class="card-donwload">
                            <h6>
                                {{ __('general.policy_and_terms') }}
                            </h6>
                            <span class="bx bx-cloud-download"></span>
                        </div>
                        <div class="but-subscribe">
                            <button type="button" onclick='window.location.href="{{ route("subscribe.index" , $club->getEncryptedId()) }}"'>{{ getClubSubscribeText($club) }}</button>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- --- End Service -->
    </main>
    <!-- --- End Main -->
@endsection
