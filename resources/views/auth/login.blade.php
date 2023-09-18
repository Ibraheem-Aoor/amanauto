<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('general.app_name') }} | {{ __('auth.login') }}</title>
    <!-- ----------- -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:ital@1&family=Cairo:wght@200;300&family=Changa:wght@200;300&family=Lato:wght@300&family=Libre+Franklin:wght@300&family=Lobster&family=Noto+Sans&family=Poppins:wght@200;300&family=Prompt:wght@300&family=Raleway:wght@200&family=Roboto+Slab:wght@200&family=Roboto:wght@100&family=Scheherazade+New&family=Tajawal:wght@200;300;700&family=Yanone+Kaffeesatz&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">

    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}" />
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/user/css/arbic.css') }}" />
    @endif
    <link rel="stylesheet" href="{{ asset('assets/user/css/media.css') }}" />
    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
</head>


<body>
    @include('layouts.user.header')
    <!-- ----- Start WapperAuto -->
    <section class="WapperAuto">
        <div class="content-auto">
            <img src="{{ asset('assets/user/img/Group 4927.svg') }}" alt="">
            <form class="custom-form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="all-input-payment">
                    <label for="">
                        {{ __('backend.phone') }}:
                    </label>
                    <input type="tel" id="phone" name="phone" />
                    <input type="hidden" name="country_code">
                </div>
                <div class="all-input-payment">
                    <label for="">
                        {{ __('backend.password') }}:
                    </label>
                    <input type="password" name="password" />
                </div>
                <div class="forget-password">
                    <a href="{{ route('password.request') }}">
                        {{ __('auth.forget_password') }}
                    </a>
                </div>

                <div class="but-Auto">
                    <button type="submit" class="but-Log">{{ __('auth.login') }}</button>
                </div>
                <div class="signUp">
                    <p>
                        {{ __('backend.not_registered') }}?.<a
                            href="{{ route('register') }}">{{ __('backend.sign_up') }}</a>
                </div>
            </form>
        </div>
    </section>
    <!-- --- End WapperAuto -->
    <script src="{{ asset('assets/user/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>

    <script src="{{ asset('assets/user/js/master.js') }}"></script>
    {{-- Toastr js --}}
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    {{-- tel input --}}
    <script>
        $(document).ready(function() {
            var input = document.querySelector("#phone");
            var iti = window.intlTelInput(input, {
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
                initialCountry: "sa",
                separateDialCode: false,
            });
            // Intercept form submission
            $('form.custom-form').on('submit', function(event) {
                event.preventDefault();
                // Get the selected country data to get dialcode along with phone
                var selectedCountryData = iti.getSelectedCountryData();
                $('input[name="country_code"]').val(selectedCountryData.dialCode);
                // Now submit the form
                $('button[type="submit"]').click();

            });
        });
    </script>

</body>

</html>
