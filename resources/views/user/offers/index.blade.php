@extends('layouts.user.master')
@section('content')
    <!-- --- Start Main -->
    <main id="Main">
        <section class="coverImage">
            <div class="container">
                <div class="bg-cover-page">
                    <img src="{{ asset('assets/user/img/covers.png') }}" alt="">
                </div>
            </div>
        </section>
        <!-- ------- -->
        <section class="sec_Info_Card">
            <div class="container">
                <div class="row">
                    @forelse ($offers as $offer)
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="box-gray">
                                <div class="flex-title-top-infos"
                                    onclick='window.location.href="{{ route("offers.show", $offer->getEncryptedId()) }}"'>
                                    <h4>
                                        {{ $offer->name }}
                                    </h4>
                                    <h6>
                                        {{ getFormattedDiscountText($offer->discount_value, $offer->discount_type) }}
                                    </h6>
                                </div>
                                <article class="flex-info-detalis-card">
                                    <article
                                        onclick='window.location.href="{{ route("offers.show", $offer->getEncryptedId()) }}"'>
                                        <h5>
                                            {{ $offer->company->name }}
                                        </h5>
                                        <h5>
                                            {{ __('general.end_date') }} : {{ $offer->end_date }}
                                        </h5>
                                    </article>
                                    <div class="box-download"
                                        onclick='window.location.href="{{ route("offers.pdf_download", $offer->getEncryptedId()) }}"'>
                                        <img src="{{ asset('assets/user/img/Path 13351.svg') }}" alt="">
                                    </div>
                                </article>
                            </div>
                        </div>
                    @empty
                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <h4 class="text-danger text-center">{{ __('general.no_offers_found') }}</h4>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>

    </main>
    <!-- --- End Main -->
@endsection
