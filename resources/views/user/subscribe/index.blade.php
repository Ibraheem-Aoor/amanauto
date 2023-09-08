@extends('layouts.user.master')
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
                            <div class="bg-bule-card-price w-100">
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
                            <h6>
                                {{ $club->getTotalPrice(true) }}
                            </h6>
                        </div>

                        <div class="info-payments">
                            <h5>
                                {{ __('general.have_coupon_code') }}
                            </h5>
                            <div class="flex-item-payment">
                                <article class="input-payments">
                                    <img src="{{ asset('assets/user/img/coupon.svg') }}" alt="">
                                    <input type="text" placeholder="" />
                                    <button type="button">{{ __('general.apply') }}</button>
                                </article>
                                <article class="action-payment">
                                    <button class="check-but" type="button"><span class="bx bx-check"></span></button>
                                    <button class="close-buts" type="button"><span>&times;</span></button>
                                </article>
                            </div>
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
                                    <input type="text" placeholder="{{ __('general.month/year') }}" class="input-mm" name="card_date" />
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
                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </section>
    </main>
    <!-- --- End Main -->
@endsection

@push('js')
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
@endpush
