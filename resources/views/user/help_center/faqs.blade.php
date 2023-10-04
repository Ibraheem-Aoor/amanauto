@extends('layouts.user.master')
@section('page', __('general.faqs'))
@section('content')
    <!-- --- Start Main -->
    <main id="Main">
        <div class="container-fluid p-5">
            @if (isset($faqs) && !$faqs->isEmpty())
                <!-- --- Start Sec_Questions -->
                <section>
                    <div class="container">
                        <div class="All-Questions">
                            <h4 class="text-center">{{ __('backend.cq.common_questions') }}</h4>
                            <div class="accordion mt-5 col-sm-12" id="accordionExample">
                                @foreach ($faqs as $common_question)
                                    <div class="accordion-item  col-sm-12">
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
        </div>

        @include('partials.whatsaap_section')
    </main>
    <!-- --- End Main -->
@endsection
