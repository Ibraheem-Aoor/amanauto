@extends('layouts.user.master')
@section('content')
    <!-- --- Start Main -->
    <main id="Main">
        <!-- -- -Start Offer Detalis -->
        <section class="offer-detalis">
            <div class="container">
                <div class="center-card ">
                    <div class="barCode text-center">
                        {!! str_replace(
                            '<?xml version="1.0"encoding="UTF-8"?>>',
                            '',
                            QrCode::size(100)->generate('https://www.google.com'),
                        ) !!}
                    </div>
                    <img src="{{ asset('assets/user/img/Group 4927.svg') }}" class="logo-tops" alt="">
                    <div class="bg-bule-card-price ">

                        <div class="info-card-clubs">
                            <h6>
                                {{ __('general.amanauto_ams') }}: <span>{{ $user->ams }}</span>
                            </h6>
                            <h6>
                                {{ __('general.vin') }} : <span>WBAYG01256EDE597</span>
                            </h6>
                            <h6>
                                {{ __('backend.end_date') }} : <span> 20 / 12 / 2023</span>
                            </h6>
                        </div>
                        <img src="{{ asset('assets/user/img/Group 4993.svg') }}" class="logoCard" alt="">

                        <img src="{{ asset('assets/user/img/Group 4962.png') }}" class="shapeCard" alt="">
                    </div>
                </div>
                <div class="content-offer-center">
                    {!! $offer->description !!}
                </div>
            </div>
        </section>
        <!-- ---- End Offer Detalis -->
    </main>
    <!-- --- End Main -->
@endsection
