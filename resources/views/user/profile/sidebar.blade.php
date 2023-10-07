<div class="col-sm-12 col-md-5 col-lg-4 customeRowProfiles">
    <div class="link-page-profile">
        <a href="{{ route('profile.show') }}" class="flex-items-prfoile">
            <i class="bx bx-user bg-icon"></i>
            <span>{{ __('general.my_accounts') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a>
        {{-- <a href="" class="flex-items-prfoile">
            <i class="bx bxs-inbox bg-icon"></i>
            <span>{{ __('general.inbox') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a> --}}
        <a href="{{ route('profile.docs.offers') }}" class="flex-items-prfoile">
            <i class="bx bx-file bg-icon"></i>
            <span>{{ __('general.offers') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a>
        <a href="{{ route('profile.docs.subscriptions') }}" class="flex-items-prfoile">
            <i class="bx bx-file bg-icon"></i>
            <span>{{ __('general.documents') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a>
        {{-- <a href="" class="flex-items-prfoile">
            <i class="bx bx-card bg-icon"></i>
            <span>{{ __('general.cards_settings') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a> --}}

        <h5>
            {{ __('general.app') }}
        </h5>
        <a href="" class="flex-items-prfoile">
            <i class="bx bx-cog bg-icon"></i>
            <span>{{ __('general.settings') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a>
        <a href="{{ route('profile.password.index') }}" class="flex-items-prfoile">
            <i class="bx bxs-cog bg-icon"></i>
            <span>{{ __('general.security') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a>
        <a href="{{ route('profile.notifications.index') }}" class="flex-items-prfoile">
            <i class="bx bx-bell bg-icon"></i>
            <span>{{ __('general.notifications') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a>
        <a href="{{ route('contact.index') }}" class="flex-items-prfoile">
            <i class="bx bx-help-circle bg-icon"></i>
            <span>{{ __('general.help_center') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a>
        <a href="{{ route('faqs.index') }}" class="flex-items-prfoile">
            <i class="bx bx-help-circle bg-icon"></i>
            <span>{{ __('general.faqs') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a>
        <a href="{{ route('about_us') }}" class="flex-items-prfoile">
            <i class="bx bx-info-circle bg-icon"></i>
            <span>{{ __('general.info') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
        </a>
        @php
            $locale = app()->getLocale();
        @endphp
        <a href="{{ route('change_language', ['locale' => $locale == 'ar' ? 'en' : 'ar']) }}"
            class="flex-items-prfoile">
            <i class="bx bx-flag bg-icon"></i>
            <span>{{ $locale == 'en' ? 'العربية' : 'English' }}</span>
        </a>
        <a href="#" class="flex-items-prfoile mt-5" onclick="$('#logout-form').submit();">
            <i class="bx bx-info-circle bg-icon text-white bg-danger"></i>
            <span>{{ __('general.logout') }}</span>
            <i class="bx bx-chevron-right back-page"></i>
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
            </form>
        </a>
    </div>
</div>
