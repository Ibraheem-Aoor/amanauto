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
                        <div class="group-notifcation">
                            <h4>
                                {{ __('general.notifications') }}
                            </h4>
                            @foreach ($notifications as $notification)


                                @php
                                    $currentLocale = app()->getLocale();
                                    $notification_translation=\App\Models\NotificationTranslation::where('notification_id',$notification->id)->where('locale',$currentLocale)->first();
                                @endphp

                                <div class="card-noto">
                                    <img src="assest/img/author-image1.jpg" alt="">
                                    <h4>
                                        {{ $notification_translation->data['title'] }}
                                    </h4>
                                    <h6>
                                        {{ $notification->date }}
                                    </h6>
                                    <p>
                                        {{ $notification_translation->data['body'] }}
                                    </p>
                                </div>
                            @endforeach
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
