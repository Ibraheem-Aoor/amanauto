@extends('layouts.user.master')
@section('page', __('general.help_center'))
@section('content')
    <!-- --- Start Main -->
    <main id="Main">
        <div class="container-fluid p-5">
            <!-- --- Start Sec_Questions -->
            <form class="custom-form" action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <section class="text-center">
                    <div class="container">
                        <div class="All-Questions">
                            <h4>{{ __('general.help_center') }}</h4>
                            <h5 class="text-primary text-center">
                                {{ __('general.have_a_problem') }}
                            </h5>
                            <h6 class="text-center text-secondary">
                                {{ __('general.contact_us_now') }}
                            </h6>
                            <div class=" col-sm-12 text-center">
                                <div class="all-input-payment col-sm-4 m-auto">
                                    <label for="">
                                        {{ __('general.subject') }}:
                                    </label>
                                    <select name="subject_id" class="form-control">
                                        <option value="">{{ __('backend.select') }}</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class=" col-sm-12 text-center">
                                <div class="all-input-payment  col-sm-12 m-auto mt-5">
                                    <label for="">
                                        {{ __('general.description') }}:
                                    </label>
                                    <textarea name="details" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="all-input-payment col-sm-6 m-auto mt-5">
                                <div class="but-Auto">
                                    <button type="submit" class="but-Log">{{ __('general.send') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </form>
        </div>
        <!-- --- End Sec_Questions -->
        @include('partials.whatsaap_section')
    </main>
    <!-- --- End Main -->
@endsection
