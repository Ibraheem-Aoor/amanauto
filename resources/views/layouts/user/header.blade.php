<!-- --- Start Header -->
<header class="headerPage" id="HeaderPage">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/user/img/Group 4927.svg') }}" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="bx bx-menu-alt-left"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('home') }}">{{ __('general.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('offers.index') }}">{{ __('general.offers') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clubs.index') }}">{{ __('general.clubs') }}</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <div class="info-header-action-but">
                        @auth
                            <div class="box-profile" onclick='window.location.href="{{ route("profile.index") }}"'>
                                <span class="bx bxs-user"></span>
                            </div>
                        @endauth
                        <div class="box-change-Languages">
                            @php
                                $locale = app()->getLocale() == 'ar' ? 'en' : 'ar';
                            @endphp
                            <a href="{{ route('change_language', ['locale' => $locale]) }}">
                                {{ $locale == 'ar' ? 'العربية' : 'English' }}</a>
                        </div>
                        @guest
                            <div class="actionBut">
                                <a href="{{ route('login') }}" class="butBgAuto">{{ __('backend.sign_in') }}</a>
                                <a href="{{ route('register') }}" class="butNoBg">{{ __('backend.sign_up') }}</a>
                            </div>
                        @endguest

                    </div>
                </form>
            </div>
        </div>
    </nav>
</header>
<!-- --- End Header -->
<!-- --- Start Header Mobile -->
<div class="header-mobile">
    <div class="flex-page-links">
        <a href="index.html" class="activePage">
            <i class="bx bx-home"></i>
            <span class="">Home</span>
        </a>
        <!-- ---- -->
        <a href="offers.html">
            <i class="bx bxs-discount"></i>
            <span class="">Offers</span>
        </a>
        <!-- --------- -->
        <a href="{{ route('clubs.index') }}">
            <i class="bx bx-crown"></i>
            <span class="">Clubs</span>
        </a>
        <!-- ---- -->
        <a href="profile.html">
            <i class="bx bx-user"></i>
            <span class="">Profile</span>
        </a>
    </div>
</div>
<!-- --- End End Mobile-->
