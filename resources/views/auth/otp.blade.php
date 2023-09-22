<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('general.app_name') }}| {{ __('auth.register') }}</title>
    <!-- ----------- -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:ital@1&family=Cairo:wght@200;300&family=Changa:wght@200;300&family=Lato:wght@300&family=Libre+Franklin:wght@300&family=Lobster&family=Noto+Sans&family=Poppins:wght@200;300&family=Prompt:wght@300&family=Raleway:wght@200&family=Roboto+Slab:wght@200&family=Roboto:wght@100&family=Scheherazade+New&family=Tajawal:wght@200;300;700&family=Yanone+Kaffeesatz&display=swap"
        rel="stylesheet" />


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
    <!-- ------ Start HomePage -->
    <div class="content-loading">
        <div class="lodingLogo">
            <span style="--i: 1"></span>
            <span style="--i: 2"></span>
            <span style="--i: 3"></span>
            <span style="--i: 4"></span>
            <span style="--i: 5"></span>
            <span style="--i: 6"></span>
            <span style="--i: 7"></span>
        </div>
        <svg>
            <filter id="gooey">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" />
                <feColorMatrix
                    values="
              1 0 0 0 0
              0 1 0 0 0
              0 0 1 0 0
              0 0 0 20 -10
            " />
            </filter>
        </svg>
    </div>
    @include('layouts.user.header')
    <!-- ----- Start WapperAuto -->
    <section class="WapperAuto">
        <div class="content-auto">
            <img src="{{ asset('assets/user/img/Padlock.svg') }}" alt="">
            <div class="info-from-title">
                <h4>
                    OTP
                </h4>
                <p>
                    {{ __('general.enter_otp_code') }}
                </p>
            </div>
            <form class="custom-form formOtp" action="{{ $form_action }}" method="POST">
                @csrf
                <div class="input-field">
                    <input type="number" name="otp[]" />
                    <input type="number" name="otp[]" disabled />
                    <input type="number" name="otp[]" disabled />
                    <input type="number" name="otp[]" disabled />
                    <input type="number" name="otp[]" disabled />
                </div>
                <button type="submit" id="submit-btn">{{ __('general.verify_otp') }}</button>
            </form>

        </div>
    </section>
    <!-- --- End WapperAuto -->
    <script src="{{ asset('assets/user/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/main.js') }}"></script>

    <script src="{{ asset('assets/user/js/master.js') }}"></script>
    {{-- Toastr js --}}
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script>
        const otpinputs = document.querySelectorAll("input"),
            button = document.getElementById("submit-btn");

        // iterate over all otpinputs
        otpinputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                // This code gets the current input element and stores it in the currentInput variable
                // This code gets the next sibling element of the current input element and stores it in the nextInput variable
                // This code gets the previous sibling element of the current input element and stores it in the prevInput variable
                const currentInput = input,
                    nextInput = input.nextElementSibling,
                    prevInput = input.previousElementSibling;

                // if the value has more than one character then clear it
                if (currentInput.value.length > 1) {
                    currentInput.value = "";
                    return;
                }
                // if the next input is disabled and the current value is not empty
                //  enable the next input and focus on it
                if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }

                // if the backspace key is pressed
                if (e.key === "Backspace") {
                    // iterate over all otpinputs again
                    otpinputs.forEach((input, index2) => {
                        // if the index1 of the current input is less than or equal to the index2 of the input in the outer loop
                        // and the previous element exists, set the disabled attribute on the input and focus on the previous element
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            input.value = "";
                            prevInput.focus();
                        }
                    });
                }
                //if the fourth input( which index number is 3) is not empty and has not disable attribute then
                //add active class if not then remove the active class.
                if (!otpinputs[4].disabled && otpinputs[4].value !== "") {
                    button.classList.add("active");
                    return;
                } else {
                    button.classList.remove("active");
                }
            });
        });

        //focus the first input which index is 0 on window load
        window.addEventListener("load", () => otpinputs[0].focus());
    </script>
</body>

</html>
