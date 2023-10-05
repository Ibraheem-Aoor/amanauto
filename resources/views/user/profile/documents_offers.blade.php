@extends('layouts.user.master')
@section('page', __('general.profile'))
@push('css')
    <style>
        .active {
            border-color: #1DC1DD !important
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
                            @forelse ($offers as $offer)
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="box-gray">
                                        <div class="flex-title-top-infos"
                                            onclick='window.location.href="{{ route('offers.show', $offer->getEncryptedId()) }}"'>
                                            <h4>
                                                {{ $offer->name }}
                                            </h4>
                                            <h6>
                                                {{ getFormattedDiscountText($offer->discount_value, $offer->discount_type) }}
                                            </h6>
                                        </div>
                                        <article class="flex-info-detalis-card">
                                            <article
                                                onclick='window.location.href="{{ route('offers.show', $offer->getEncryptedId()) }}"'>
                                                <h5>
                                                    {{ $offer->company->name }}
                                                </h5>
                                                <h5>
                                                    {{ __('general.end_date') }} : {{ $offer->end_date }}
                                                </h5>
                                            </article>
                                            <div class="box-download"
                                                onclick='window.location.href="{{ route('offers.pdf_download', ['id' => $offer->getEncryptedId(), 'preview_type' => 'download']) }}"'>
                                                <img src="{{ asset('assets/user/img/Path 13351.svg') }}" alt="">
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            @empty
                                <div class="col-sm-12 col-md-6 col-lg-12 text-center">
                                    <h4 class="text-danger text-center">{{ __('general.no_offers_found') }}</h4>
                                </div>
                            @endforelse
                            @include('user.partials.pagination', ['items' => $offers])
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
