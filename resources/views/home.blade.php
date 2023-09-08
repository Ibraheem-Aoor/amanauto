@extends('layouts.user.master')
@section('content')
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
                                    <i class="bx bx-euro"></i>
                                    <span>3.210,00</span>
                                </h6>
                                <img src="{{ asset('assets/user/img/waving-hand_1f44b.png') }}" alt="" />
                            </div>
                            <h4>{{ __('general.home_page.first_headline') }}</h4>
                            <p>
                                {{ __('general.home_page.first_headline_text') }}
                            </p>
                            <h6>{{ __('general.home_page.second_headline') }}</h6>
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
                            <img src="{{ asset('assets/user/img/Image 1.png') }}" class="w-100" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- --- End_Cover -->
        @if (isset($entities) && !$entities->isEmpty())
            <!-- -- Start Client -->
            <section class="client">
                <div class="container">
                    <h4>{{ __('general.home_page.entities_headline') }}</h4>
                    <div class="row mt-5">
                        @foreach ($entities as $entity)
                            <div class="col-sm-12 col-md-6 col-lg-3 customeClientCard">
                                <div class="client-card">
                                    <img src="{{ getImageUrl($entity->web_img) }}" alt="" />
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
            <!-- --- End Client -->
        @endif
        @if (isset($services) && !$services->isEmpty())
            <!-- ---- Start Sevice -->
            <section class="sevice">
                <div class="container">
                    <div class="All-Card-Service">
                        <h4>{{ __('general.home_page.services_headline') }}</h4>
                        <div class="row">
                            @foreach ($services as $service)
                                <div class="col-sm-12 col-md-12 col-lg-4 customeBoxService">
                                    <div class="card-service">
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
        <section class="SubScribe text-center"">
            <div class="container">
                <div class="All-Card-Service">
                    <h4>Subscribtions Steps</h4>
                    <div class="row justify-content-between">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card-sub">
                                <img src="{{ asset('assets/user/img/add-user.svg') }}" alt="" />
                                <h5>Register</h5>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card-sub">
                                <img src="{{ asset('assets/user/img/id-card.svg') }}" alt="" />
                                <h5>Subscription</h5>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card-sub customeTestRight text-right">
                                <img src="{{ asset('assets/user/img/call.svg') }}" alt="" />
                                <h5>Service Call</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- --- End SubScribe -->
        @if (isset($common_questions) && !$common_questions->isEmpty())
            <!-- --- Start Sec_Questions -->
            <section class="sec-questions">
                <div class="container">
                    <div class="All-Questions">
                        <h4>{{ __('backend.cq.common_questions') }}</h4>
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
        @include('partials.whatsaap_section')
    </main>
    <!-- --- End Main -->
@endsection

@push('js')
    <script>
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @elseif (Session::has('success'))
        console.log('SS');
            toastr.success("{{ Session::get('success') }}");
        @endif
    </script>
@endpush
