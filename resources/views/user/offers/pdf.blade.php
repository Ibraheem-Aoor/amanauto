<!DOCTYPE html>
@if ($lang == 'ar')
    <html lang="ar" dir="rtl">
@else
    <html lang="en" dir="ltr">
@endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $offer->name }}</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            direction: rtl !important;
            font-family: 'Tajawal', sans-serif !important;
        }

        body {
            margin: 0;
            font-family: var(--bs-font-sans-serif);
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }

        #Main {
            padding-bottom: 80px;
            margin-top: 20% !important;
        }

        .container,
        .container-fluid,
        .container-lg,
        .container-md,
        .container-sm,
        .container-xl,
        .container-xxl {
            width: 100%;
            padding-right: var(--bs-gutter-x, .75rem);
            padding-left: var(--bs-gutter-x, .75rem);
            margin-right: auto;
            margin-left: auto;
        }

        .center-card {
            width: 100%;
            margin: 25px auto;
            text-align: center !important
        }

        .barCode {
            width: 160px;
            height: 160px;
            margin: 12px auto;
            display: block;
            text-align: center !important;
        }

        .logo-tops {
            width: 200px;
            height: 160px;
            margin: 12px auto;
            display: block;
            text-align: center !important;
        }

        .bg-bule-card-price {
            border-radius: 20px;
            background: linear-gradient(270deg, #219BB0 0%, #1DC1DD 100%);
            box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.22);
            padding: 25px;
            position: relative;
            overflow: hidden;
            margin: 15px 0px;
            transition: all .2s ease-in-out;
            cursor: pointer;
        }

        .bg-bule-card-price h6 {
            font-size: 20px;
        }

        .bg-bule-card-price span {
            color: #fff;
            margin: 0px 15px;
        }

        .logoCard {
            width: 120px;
            height: 60px;
            position: absolute;
            bottom: 0px;
        }

        .shapeCard {
            position: absolute;
            bottom: 0px;
            right: 0% !important;
            width: 150px;
            height: 150px;
        }

        li {
            list-style-type: none;
            list-style-image: none;
            list-style-position: unset;
        }

        img,
        svg {
            vertical-align: middle;
        }
    </style>

    @if ($lang == 'ar')
        <style>
            .shapeCard {
                margin-right: 20% !important;
            }

            .logoCard {
                margin-left: 20% !important;
            }
        </style>
    @else
        <style>
            .shapeCard {
                margin-left: 20% !important;
            }

            .logoCard {
                margin-right: 20% !important;
            }
        </style>
    @endif

</head>

<body>
    <!-- --- Start Main -->
    <main id="Main">
        <!-- -- -Start Offer Detalis -->
        <section class="offer-detalis">
            <div class="container">
                <div class="center-card ">
                    <div class="barCode">
                        {!! $qr_code !!}
                    </div>
                    <img src="{{ public_path('assets/user/img/Group 4927.svg') }}" class="logo-tops" alt="">
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
                        <img src="{{ public_path('assets/user/img/Group 4993.svg') }}" class="logoCard" alt="">

                        <img src="{{ public_path('assets/user/img/Group 4962.png') }}" class="shapeCard" alt="">
                    </div>
                </div>
                <div class="content-offer-center">
                    {!! $offer->translate('ar')->description !!}
                </div>
            </div>
        </section>
        <!-- ---- End Offer Detalis -->
    </main>
    <!-- --- End Main -->
</body>

</html>
