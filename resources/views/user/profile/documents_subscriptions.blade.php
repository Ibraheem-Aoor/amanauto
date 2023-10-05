@extends('layouts.user.master')
@section('page', __('general.profile'))
@push('css')
    <style>
        .document-img {
            object-fit: contain !important;
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
                            @forelse ($subscriptions as $subscription)
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="card-docounent">
                                        <img src="{{ getImageUrl($subscription->img_vehicle) }}" class="document-img">
                                        <h4>
                                            {{ $subscription->club?->name }}
                                        </h4>
                                        <div class="flex-but-document">
                                            <button class="but-donwload"
                                                onclick='window.location.href="{{ route('file.download', ['path' => getImageUrl($subscription->img_vehicle)]) }}"'>
                                                <i class="bx bx-download"></i>
                                                <span>
                                                    {{ __('general.download') }}
                                                </span>
                                            </button>
                                            <button class="but-view"
                                                onclick="window.open('{{ getImageUrl($subscription->img_vehicle) }}', '_blank')">
                                                <i class="bx bx-show"></i>
                                                <span>
                                                    {{ __('general.view') }}
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="card-docounent">
                                        <img src="{{ getImageUrl($subscription->img_vehicle) }}" class="document-img">
                                        <h4>
                                            {{ $subscription->club?->name }}
                                        </h4>
                                        <div class="flex-but-document">
                                            <button class="but-donwload"
                                                onclick='window.location.href="{{ route('file.download', ['path' => getImageUrl($subscription->img_vehicle)]) }}"'>
                                                <i class="bx bx-download"></i>
                                                <span>
                                                    {{ __('general.download') }}
                                                </span>
                                            </button>
                                            <button class="but-view"
                                                onclick="window.open('{{ getImageUrl($subscription->img_vehicle) }}', '_blank')">
                                                <i class="bx bx-show"></i>
                                                <span>
                                                    {{ __('general.view') }}
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-sm-12 col-md-6 col-lg-12 text-center">
                                    <h4 class="text-danger text-center">{{ __('general.no_offers_found') }}</h4>
                                </div>
                            @endforelse
                            @include('user.partials.pagination', ['items' => $subscriptions])
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
