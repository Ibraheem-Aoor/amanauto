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
                        @isset($club)
                            <div class="bg-bule-card-price" style="background: {{ $club->color }} !important;">
                                <div class="info-card-clubs">
                                    <h3>
                                        {{ $club->name }}
                                    </h3>
                                    <h6>
                                        {{ __('general.amanauto_ams') }}: <span>{{ $user->ams }}</span>
                                    </h6>
                                    <h6>
                                        {{ __('general.vin') }} : <span>{{ $user->vin }}</span>
                                    </h6>
                                    <h6>
                                        {{ __('backend.end_date') }} : <span> {{ getSubscriptionEndDate($club) }}</span>
                                    </h6>
                                </div>
                                <img src="{{ asset('assets/user/img/Group 4993.svg') }}" class="logoCard" alt="">
                                <img src="{{ asset('assets/user/img/Group 4962.png') }}" class="shapeCard" alt="">
                            </div>
                        @endisset

                        @isset($club)
                            <h4 class="title-service">
                                {{ __('backend.services') }}
                            </h4>
                            @foreach ($services as $service)
                                <div class="custome-profile-acceess">
                                    <article>
                                        <h4>
                                            {{ $service->name }}
                                        </h4>
                                        {{-- <h6>
                                            Today - 18:21
                                        </h6> --}}
                                    </article>
                                    {{-- <h3>
                                        Open
                                    </h3> --}}
                                </div>
                            @endforeach
                        @endisset
                        <!-- ---------- -->
                        @if ($offers)
                            <h4 class="title-service">
                                {{ __('general.offers_for_you') }}
                            </h4>
                            @foreach ($offers as $offer)
                                <div class="custome-flex-offers"
                                    onclick='window.location.href="{{ route('offers.show', $offer->getEncryptedId()) }}"'>
                                    <article>
                                        <h5>
                                            {{ $offer->name }}
                                        </h5>
                                        <h6>
                                            {{ $offer->company->name }}
                                        </h6>
                                    </article>
                                    <article>
                                        <h3 class="colorReds">
                                            {{ getFormattedDiscountText($offer->discount_value, $offer->discount_type) }}
                                        </h3>
                                        <h6>
                                            {{ __('general.end_date') }} : {{ $offer->end_date }}
                                        </h6>
                                    </article>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- ----- End Section Profile -->
    </main>
    <!-- --- End Main -->
@endsection
