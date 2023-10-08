@extends('layouts.user.master')
@section('page', __('general.home'))
@push('css')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/user/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/slick.css') }}">
    <style>
        .sevice {
            margin-top: 5% !important;
        }
    </style>
@endpush
@section('content')
    @php
        $locale = app()->getLocale();
    @endphp
    <!-- --- Start Main -->
    <main id="Main">
        <!-- -- Sec_Cover -->
        <section class="sec-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="content-cover">
                            <div class="flex-title-top-cover">
                                <h6>
                                    <span>@auth
                                            {{ __('general.welcome_back') . ' ' . getAuthUser('web')->name }}
                                        @endauth
                                        @guest
                                            {{ __('general.welcome_to_site') }}
                                        @endguest
                                    </span>
                                </h6>
                                <img src="{{ asset('assets/user/img/waving-hand_1f44b.png') }}" alt="" />
                            </div>
                            <h4>{{ getSetting('home_page_slogan_1') }}</h4>
                            <p>
                                {{ getSetting('home_page_short_intro') }}
                            </p>
                            <h6>{{ getSetting('home_page_slogan_2') }}</h6>
                            <div class="info-download-image">
                                <img src="{{ asset('assets/user/img/Download-On-The-App-Store-PNG-Photos.png') }}"
                                    alt="" />
                                <img src="{{ asset('assets/user/img/badge-google-play-and-app-store-button-download-free-png.webp') }}"
                                    alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="image-cover">
                            <img src="{{ getImageUrl(getSetting('home_page_intro_image')) }}" class="w-100"
                                alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- --- End_Cover -->
        @if (isset($entities) && !$entities->isEmpty())
            <!-- -- Start Client -->
            <section class="client" data-aos="fade-right" data-aos-duration="3000">
                <div class="container">
                    <h4>{{ getSetting('home_page_entities_title') }}</h4>
                    <div class="row-client">
                        @foreach ($entities as $entity)
                            <div class="client-card">
                                <img src="{{ getImageUrl($entity->web_img) }}" alt="" />
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
            <!-- --- End Client -->
        @endif
        @if (isset($services) && !$services->isEmpty())
            <!-- ---- Start Sevice -->
            <section class="sevice" data-aos="fade-down" data-aos-duration="3000">
                <div class="container">
                    <div class="All-Card-Service">
                        <h4>{{ getSetting('home_page_services_title') }}</h4>
                        <div class="row">
                            @foreach ($services as $service)
                                <div class="col-sm-12 col-md-12 col-lg-4 customeBoxService">
                                    <div class="card-service" data-name="{{ $service->name }}"
                                        data-img="{{ getImageUrl($service->web_img) }}"
                                        data-description="{{ $service->description }}" data-img="{{ $service->web_img }}">
                                        <img src="{{ getImageUrl($service->web_img) }}" alt="{{ $service->name }}"
                                            loading="lazy" />
                                        <h5>{{ $service->name }}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <!-- --- End Service -->
        @endif

        <!-- --- Start SubScribe -->
        <section class="SubScribe text-center" data-aos="zoom-in" data-aos-duration="3000">
            <div class="container">
                <div class="All-Card-Service">
                    <h4>{{ __('general.subscribtions_steps.subscribtions_steps') }}</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card-sub">
                                <img src="{{ asset('assets/user/img/add-user.svg') }}" alt="" />
                                <h5>{{ __('general.subscribtions_steps.register') }}</h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card-sub">
                                <img src="{{ asset('assets/user/img/id-card.svg') }}" alt="" />
                                <h5>{{ __('general.subscribtions_steps.subscription') }}</h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card-sub customeTestRight text-right">
                                <img src="{{ asset('assets/user/img/call.svg') }}" alt="" />
                                <h5>{{ __('general.subscribtions_steps.service_call') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- --- End SubScribe -->
        @if (isset($common_questions) && !$common_questions->isEmpty())
            <!-- --- Start Sec_Questions -->
            <section class="sec-questions" data-aos="zoom-out" data-aos-duration="3000">
                <div class="container">
                    <div class="All-Questions">
                        <h4>{{ getSetting('home_page_faqs_title') }}</h4>
                        <div class="accordion mt-5" id="accordionExample">
                            @foreach ($common_questions as $common_question)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne-{{ $loop->index }}" aria-expanded="true"
                                            aria-controls="collapseOne-{{ $loop->index }}">
                                            {{ $common_question->question }}
                                        </button>
                                    </h2>
                                    <div id="collapseOne-{{ $loop->index }}" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {{ $common_question->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
            <!-- --- End Sec_Questions -->
        @endif
        <!-- --- Start Pop Up Service -->
        <section class="pop-ser">
            <div class="container">
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="service-details-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <span data-bs-dismiss="modal" aria-label="Close">&times;</span>

                            </div>
                            <div class="modal-body">
                                <img src="" />
                                <p>

                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="but-save-foot m-auto" onclick='window.location.href="{{ route("clubs.index") }}"'
                                    class="col-sm-12">{{ __('general.subscribe_now') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ---- End Pop Up Servucice -->
        @include('partials.whatsaap_section')
    </main>
    <!-- --- End Main -->
@endsection

@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('assets/user/js/slick.min.js') }}"></script>
    <script>
        var isRtlEnabled = "{{ app()->getLocale() == 'ar' }}";
    </script>
    <script src="{{ asset('assets/user/js/silder-en.js') }}"></script>
    <script src="{{ asset('assets/user/js/main.js') }}?v=0.01"></script>


    <script>
        $('.row-client').on('init', function(event, slick) {
            console.log('#productsCarousel init');

            AOS.init({
                easing: 'ease-out-back',
                duration: 1000
            });
        });
        AOS.init();

        $(document).on('click', '.card-service', function(e) {
            console.log('SS');
            $('#service-details-modal .modal-title').text($(this).data('name'));
            $('#service-details-modal .modal-body img').prop('src' , $(this).data('img'));
            $('#service-details-modal .modal-body p').text($(this).data('description'));
            $('#service-details-modal').modal('show');
        });
    </script>
@endpush
