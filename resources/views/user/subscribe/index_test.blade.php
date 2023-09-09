@extends('layouts.user.master')
@push('css')
    <style>
        .applied-coupon {
            letter-spacing: 3px;
            padding: 10px 4px;
            color: red;
        }
    </style>

    <style>
        apple-pay-button {
            outline: none;
            width: 40%;
            height: 50px;
            border-radius: 54px;
            margin: 30px auto;
            color: #FFF;
            font-size: 23px;
            font-style: normal;
            font-weight: 400;
            display: block;
        }
    </style><!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.10.0/moyasar.css" />
@endpush
@section('content')
    <!-- --- Start Main -->
    <main id="Main">
        <section class="view-Order">
            <form class="method-payment custom-form" action="{{ route('subscribe.make_payment', $club->getEncryptedId()) }}"
                enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="club_id" value="{{ $club->getEncryptedId() }}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-6 col-lg-7 CutomeOrderColum">
                            <div class="content-view-order">
                                <h4>
                                    {{ __('general.vichle_istimara') }} <span>*</span>
                                </h4>
                                <div class="flex-image-uploads">
                                    <div onclick="HeaderThreeUpload();" class="box-upload">
                                        <span></span>
                                        <img src="{{ asset('assets/user/img/gallery.svg') }}" alt="">
                                        <input type="file" id="InputFileImage" name="img_vehicle" hidden />
                                    </div>
                                    <img id="UploadImageFile" src="{{ asset('dist/img/product-placeholder.webp') }}"
                                        alt="">
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-5 CutomeOrderColum">
                            <div class="bg-bule-card-price w-100" style="background: {{ $club->color }} !important;">
                                <h3>
                                    {{ $club->name }}
                                </h3>
                                <div class="info-card-clubs">
                                    <h6>
                                        {{ __('general.times') }} : <span>{{ $club->times }}</span>
                                    </h6>
                                    <h6>
                                        {{ __('general.duration') }} : <span>{{ $club->duration }}</span>
                                    </h6>
                                </div>
                                <h2>
                                    {{ formatPrice($club->price) }}

                                </h2>
                                <img src="{{ asset('assets/user/img/Group 4962.png') }}" class="shapeCard" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="detalis-orders">
                        <h4>
                            {{ __('general.your_order') }}
                        </h4>
                        <div class="flex-info-detalis-order">
                            <h6>
                                {{ __('general.product') }}
                            </h6>
                            <h6>
                                {{ __('general.total') }}
                            </h6>
                        </div>
                        <div class="flex-info-detalis-order">
                            <h6>
                                {{ $club->name }} × 1
                            </h6>
                            <h6>
                                {{ formatPrice($club->price) }}
                            </h6>
                        </div>
                        <div class="flex-info-detalis-order">
                            <h6>
                                {{ __('general.total_with_vat') }} {{ getFormatedClubVat($club) }}
                            </h6>
                            <h6 id="total-price">
                                {{ $club->getTotalPrice(true) }}
                            </h6>
                        </div>

                        <div class="info-payments">
                            <h5 onclick="showCouponDiv($(this));">
                                {{ __('general.have_coupon_code') }}
                            </h5>

                            <!-- -------- -->
                            <h4>
                                {{ __('general.payment_method') }}
                            </h4>

                            <div class="flex-image-payment">
                                <input type="radio" name="payment_method" value="credit_card" />
                                <article class="imagep-payment">
                                    <img src="{{ asset('assets/user/img/Image 20.png') }}" alt="">
                                    <img src="{{ asset('assets/user/img/visa-color.png') }}" alt="">
                                    <img src="{{ asset('assets/user/img/mastercard-color.png') }}" alt="">
                                </article>
                            </div>
                            <div class="payment-method mt-3">
                                <div class="card-al-input">
                                    <input type="text" placeholder="{{ __('general.card_number') }}"
                                        class="input-number" name="card_number" />
                                    <input type="text" placeholder="{{ __('general.month/year') }}" class="input-mm"
                                        name="card_date" />
                                    <input type="text" placeholder="CVC" class="CVC" name="cvc" />
                                </div>

                            </div>
                            <!-- ----------------- -->

                            <div class="flex-image-payment mt-4">
                                <input type="radio" name="payment_method" value="partial" />
                                <article class="content-payment">
                                    <span>3 interest free payment of <b>89,6 SAR</b> <a href="">Learn more</a>
                                    </span>
                                </article>
                            </div>
                            <div class="flex-chart">
                                <div class="box-chart customeLineAfter">
                                    <div class="box-image-chart">
                                        <img src="{{ asset('assets/user/img/Group 4995.svg') }}" alt="">
                                        <div class="pos-numper">
                                            <span>1</span>
                                        </div>
                                    </div>
                                    <div class="content-chart">
                                        <h4>
                                            <b>
                                                89,6 SAR
                                            </b>
                                        </h4>
                                        <h6>
                                            Today
                                        </h6>
                                    </div>
                                </div>
                                <div class="box-chart customeLineAfter">
                                    <div class="box-image-chart ">
                                        <img src="{{ asset('assets/user/img/Group 4995.svg') }}" alt="">
                                        <div class="pos-numper">
                                            <span>2</span>
                                        </div>
                                    </div>
                                    <div class="content-chart">
                                        <h4>
                                            <b>
                                                89,6 SAR
                                            </b>
                                        </h4>
                                        <h6>
                                            In 1 month
                                        </h6>
                                    </div>
                                </div>
                                <div class="box-chart">
                                    <div class="box-image-chart">
                                        <img src="{{ asset('assets/user/img/Group 4995.svg') }}" alt="">
                                        <div class="pos-numper">
                                            <span>3</span>
                                        </div>
                                    </div>
                                    <div class="content-chart">
                                        <h4>
                                            <b>
                                                89,6 SAR
                                            </b>
                                        </h4>
                                        <h6>
                                            In 2 months
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="but-payment">
                                <button type="submit">{{ __('general.comlete_payment') }}</button>
                                <apple-pay-button buttonstyle="black" onclick="onApplePayButtonClicked()" type="plain"
                                    locale="en"></apple-pay-button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <div class="mysr-form"></div>
        </section>
    </main>
    <!-- --- End Main -->
@endsection

@push('js')
    <!-- Moyasar Scripts -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.10.0/moyasar.js"></script>
    <div class="mysr-form"></div>
    <script>
        Moyasar.init({
            element: '.mysr-form',

            // Amount in the smallest currency unit.
            // For example:
            // 10 SAR = 10 * 100 Halalas
            // 10 KWD = 10 * 1000 Fils
            // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
            amount: 1000,
            currency: 'SAR',
            description: 'Coffee Order #1',
            publishable_api_key: 'pk_test_AQpxBV31a29qhkhUYFYUFjhwllaDVrxSq5ydVNui',
            callback_url: 'https://moyasar.com/thanks',
            methods: ['applepay'],
            apple_pay: {
                country: 'SA',
                label: 'Awesome Cookie Store',
                validate_merchant_url: 'https://api.moyasar.com/v1/applepay/initiate',
            },
        });
    </script>
    <script>
        let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

        const fileNameHeaderThree = document.querySelector("#UploadImageFile");
        const InputHeaderThree = document.querySelector("#InputFileImage");
        const CutomeHeaderThree = document.querySelector("#customeButUpload");

        function HeaderThreeUpload() {
            InputHeaderThree.click();
        }
        InputHeaderThree.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    const result = reader.result;
                    fileNameHeaderThree.src = result;
                };
                // cancelBtn.addEventListener("click", function(){
                // img.src = "";
                // });
                reader.readAsDataURL(file);
            }
            if (this.value) {
                let valueStore = this.value.match(regExp);
                fileNameHeaderThree.textContent = valueStore;
            }
        });
    </script>
    {{-- check coupon code --}}
    <script>
        var is_coupon_div_visible = false;

        function showCouponDiv(src) {
            if (!is_coupon_div_visible) {
                src.after(`<div class="flex-item-payment" id="coupon-div">
                    <article class="input-payments">
                        <img src="{{ asset('assets/user/img/coupon.svg') }}" alt="">
                        <input type="text" placeholder="" name="coupon_code" />
                        <h4 class="applied-coupon"></h4>
                        <button type="button" onclick="checkCouponCode();"
                        id="applyBtn">{{ __('general.apply') }}</button>
                        </article>
                        <article class="action-payment">
                            <button class="check-but" type="button" onclick="confirmCouponCode();"><span
                                class="bx bx-check"></span></button>
                                <button class="close-buts" type="button"
                                onclick="cleanCouponCode();"><span>&times;</span></button>
                                </article>
                                </div>`);
                is_coupon_div_visible = true;
            }
        }


        $('.applied-coupon').hide();

        var discount_value = 0;
        var discount_type = null;

        function checkCouponCode() {
            var coupon_code = $('input[name="coupon_code"]').val();
            $.get("{{ route('subscribe.check_coupon_code') }}", {
                coupon_code: coupon_code,
            }, function(response) {
                if (response.is_valid) {
                    toastr.success(response.message);
                    discount_value = response.discount_value;
                    discount_type = response.discount_type;
                } else {
                    toastr.error(response.message);
                    $('input[name="coupon_code"]').val(null);
                }
            });
        }

        // clean input
        function cleanCouponCode() {
            $('input[name="coupon_code"]').val(null);
            $('.applied-coupon').hide();
            $('input[name="coupon_code"]').show();
            $('#applyBtn').show();
            discount_type = null;
            discount_value = 0;
            $('#coupon-div').remove();
            is_coupon_div_visible = false;
        }

        // confirm coupon code
        function confirmCouponCode() {
            if (discount_value != 0 && discount_type != null) {
                $('.applied-coupon').show();
                $('.applied-coupon').text($('input[name="coupon_code"]').val() + '   ' + discount_value +
                    discount_type + " {{ __('general.discount') }} ");
                $('input[name="coupon_code"]').hide();
                $('#applyBtn').hide();
            }
        }
    </script>
@endpush
