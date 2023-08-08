<nav x-data="{ open: false, bgWhite: true }"
     @if(request()->is('u') || request()->is('u/*'))
     class="navbar navbar-expand-lg sticky-top navbar-light bg-white p-0 pt-2"
     @else
     :class="{['navbar navbar-expand-lg sticky-top navbar-light mt-4']: true, 'bg-white': !bgWhite, 'bg-transparent': bgWhite}"
     @scroll.window="bgWhite = (window.pageYOffset > 20) ? false : true"
    @endif
>
    <!-- Primary Navigation Menu -->
    <div class="container siteNavbar">
        <a class="navbar-brand" href="{{ auth()->check() ? route('dash.index') : route('guest.index') }}">
            <x-application-logo class=""
                                style="height: {{ request()->is('u') || request()->is('u/*') ? '40' : '60' }}px"/>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            @if(request()->is('u') || request()->is('u/*'))
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    @role('admin')

                    <li class="nav-item text-start text-lg-center bottom-bottom-list mx-3">
                        <a href="https://offerform.metabaseapp.com/dashboard/2-offerform" class="text-decoration-none d-flex d-lg-block" target="_blank">
                            <img class="img-fluid siteImg" src="{{asset('img/menu-icons/analytics_icon.svg')}}" alt="">
                            <span class="nav-link">Analytics</span>
                        </a>
                    </li>

                    <li class="nav-item text-start text-lg-center bottom-bottom-list {{ request()->routeIs('dash.offer-forms.index') ? 'active' : '' }} mx-3">
                        <a href="{{ route('dash.offer-forms.index') }}" class="text-decoration-none d-flex d-lg-block">
                            <img class="img-fluid siteImg" src="{{asset('img/menu-icons/form-editor.svg')}}" alt="">
                            <span class="nav-link">Form Editor</span>
                        </a>
                    </li>

                    @php
                        $referralRoute = request()->routeIs('dash.referral-partners.index') || request()->routeIs('dash.referral-partners.referral-partners-by-type') || request()->routeIs('dash.referral-partners.create')
                    @endphp

                    <li class="nav-item text-start text-lg-center bottom-bottom-list

                            {{ $referralRoute ? 'active' : '' }} mx-3">
                        <a href="{{ route('dash.referral-partners.index') }}" class="text-decoration-none d-flex d-lg-block">
                            <img class="img-fluid siteImg" src="{{asset('img/menu-icons/partner_icon_pr.svg')}}" alt="">
                            <span class="nav-link">Referral Partners</span>
                        </a>
                    </li>


{{--                    <li class="nav-item text-start text-lg-center bottom-bottom-list mx-3 customUl">--}}
{{--                        <a href=""> <img class="img-fluid siteImg" src="{{asset('img/menu-icons/partner_icon_pr.svg')}}"--}}
{{--                                         alt=""></a>--}}
{{--                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">--}}
{{--                            <x-dropdown>--}}
{{--                                <x-slot name="trigger">--}}
{{--                                    Referral Partners--}}
{{--                                </x-slot>--}}
{{--                                <x-slot name="content">--}}

{{--                                    <x-dropdown-link class="fw-bold tc-black-hover-warning pb-2"--}}
{{--                                                     href="{{route('dash.referral-partners.index')}}">--}}
{{--                                        Index--}}
{{--                                    </x-dropdown-link>--}}

{{--                                </x-slot>--}}
{{--                            </x-dropdown>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                    <li class="nav-item text-start text-lg-center bottom-bottom-list mx-3 customUl">
                        <a href=""><img class="img-fluid siteImg" src="{{asset('img/menu-icons/hom_icon.svg')}}" alt=""></a>
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                            <x-dropdown class="">
                                <x-slot name="trigger">
                                    User Management
                                </x-slot>
                                <x-slot name="content" class="">
                                    <x-dropdown-link class="fw-bold tc-black-hover-warning pb-2"
                                                     href="{{ route('dash.teams.index',  ['fp' => 'f']) }}">
                                        Free Teams
                                    </x-dropdown-link>

                                    <x-dropdown-link class="fw-bold tc-black-hover-warning pb-2"
                                                     href="{{ route('dash.teams.index', ['fp' => 'p']) }}">
                                        Paid Teams
                                    </x-dropdown-link>

                                    <x-dropdown-link class="fw-bold tc-black-hover-warning pb-2"
                                                     href="{{ route('dash.users.index') }}">
                                        Agents
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </ul>
                    </li>

                    {{--                    <li class="nav-item text-start text-lg-center bottom-bottom-list {{ request()->routeIs('dash.users.index') ? 'active' : '' }} mx-3">--}}
                    {{--                        <img class="img-fluid" src="{{asset('img/menu-icons/hom_icon.svg')}}" alt="">--}}
                    {{--                        <a class="nav-link" href="{{ route('dash.users.index') }}">User Management</a>--}}
                    {{--                    </li>--}}


                    <li class="nav-item text-start text-lg-center mx-3 bottom-bottom-list customUl ">
                        <a href=""><img class="img-fluid siteImg w-18" src="{{asset('img/menu-icons/cms.svg')}}" alt=""></a>
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                            <x-dropdown>
                                <x-slot name="trigger">
                                    CMS Management
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link class="fw-bold" href="{{route('dash.home.index')}}">Home
                                    </x-dropdown-link>
                                    <x-dropdown-link class="fw-bold" href="{{route('dash.about.index')}}">About us
                                    </x-dropdown-link>
                                    <x-dropdown-link class="fw-bold" href="{{route('dash.pricing.index')}}">Pricing
                                    </x-dropdown-link>
                                    <x-dropdown-link class="fw-bold" href="{{route('dash.demos.index')}}">Demo
                                    </x-dropdown-link>
                                    <x-dropdown-link class="fw-bold" href="{{route('dash.blogs.index')}}">Blog
                                    </x-dropdown-link>
                                    <x-dropdown-link class="fw-bold" href="{{route('dash.testimonials.index')}}">
                                        Testimonials
                                    </x-dropdown-link>
                                    {{--                                    <x-dropdown-link class="fw-bold" href="{{route('dash.terms-and-conditions.index')}}">--}}
                                    {{--                                        Term and conditions--}}
                                    {{--                                    </x-dropdown-link>--}}
                                </x-slot>
                            </x-dropdown>
                        </ul>

                    </li>
                    @else
                        @hasanyrole('super-admin|admin|agent')
                        <li class="nav-item text-start text-lg-center bottom-bottom-list mx-3 {{ request()->routeIs('dash.offer-forms.index') || request()->routeIs('dash.offer-forms.edit') ? 'active' : '' }}">
                            <a href="{{ route('dash.offer-forms.index') }}" aria-current="page"
                               class="text-decoration-none d-flex d-lg-block">
                                <img class="img-fluid siteImg" src="{{asset('img/menu-icons/hom_icon.svg')}}" alt="">
                                <span class="nav-link"> OfferForms</span>
                            </a>
                        </li>
                        @endhasanyrole
                        <li class="nav-item text-start text-lg-center bottom-bottom-list mx-3 {{ request()->routeIs('dash.offer-forms.completed') ? 'active' : '' }}">
                            <a href="{{ route('dash.offer-forms.completed') }}"
                               class="text-decoration-none d-flex d-lg-block">
                                <img class="img-fluid siteImg" src="{{asset('img/menu-icons/completed_forms.svg')}}"
                                     alt="">
                                <span class="nav-link"> Completed Forms</span>
                            </a>
                        </li>
                        @php
                            $teamSubscription = auth()->user()->subscription('premium-team-monthly');
                            $team = auth()->user()->ownedTeams()->first();
                        @endphp
                        @if((($teamSubscription && $teamSubscription->valid()) || auth()->user()->current_team_id !== null) && ($team && $team->id === auth()->user()->current_team_id))
                            <li class="nav-item text-start text-lg-center bottom-bottom-list mx-3 {{ request()->routeIs('dash.teams.manager') ? 'active' : '' }}">
                                <a href="{{ route('dash.teams.manager', $team->code) }}" id="team-manager"
                                   class="text-decoration-none d-flex d-lg-block">
                                    <img class="img-fluid siteImg" src="{{asset('img/menu-icons/partner_icon_pr.svg')}}"
                                         alt="">
                                    <span class="nav-link">Team Manager</span>
                                </a>
                            </li>
                        @endif
                        @endrole

                        <li class="nav-item text-start text-lg-center bottom-bottom-list mx-3 {{ request()->routeIs('dash.settings') ? 'active' : '' }}">
                            <a href="{{ route('dash.settings') }}" class="text-decoration-none d-flex d-lg-block">
                                <img class="img-fluid siteImg" src="{{asset('img/menu-icons/setting_icon_pr.svg')}}"
                                     alt="">
                                <span class="nav-link">Settings</span>
                            </a>
                        </li>
                        @role('agent')

                        @php
                            $countNotification = auth()->user()->notifications()->whereDate('created_at', now())->count();
                        @endphp

                        <li class="nav-item text-start text-lg-center bottom-bottom-list mx-3 position-relative">

                            <img class="img-fluid siteImg " src="{{asset('img/menu-icons/notifications.svg')}}" alt=""
                                 role="button"
                                 data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                 aria-controls="offcanvasRight"
                            >
                            <a href="#" class="nav-link" role="button"
                               data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                               aria-controls="offcanvasRight"
                            >
                                Notifications
                                @if($countNotification > 0)
                                    <span class="position-absolute translate-middle badge rounded-pill bg-danger"
                                          style="top: 4px; right: 18px">
                                        {{ $countNotification }}
                                      </span>
                                @endif
                            </a>
                        </li>
                        @endrole
                </ul>
            @else
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fs-14 mx-2 fw-bold"
                           {{ request()->routeIs('guest.demo') ? 'guestActive': '' }} aria-current="page"
                           href="{{ route('guest.demo') }}">Demo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 fw-bold pricingSectionBtn"
                           href="{{route('guest.pricing')}}">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 fw-bold" href="{{ route('guest.blog') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 fw-bold" href="{{ route('guest.about') }}">About</a>
                    </li>
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link mx-2 fw-bold" href="{{ route('guest.terms-and-conditions') }}">Term & Conditions</a>--}}
                    {{--                    </li>--}}
                    <li class="nav-item">
                        <a class="nav-link mx-2 fw-bold" href="{{ route('guest.contact') }}">Contact</a>
                    </li>
                </ul>
            @endif
            @guest
                <a href="{{ route('register') }}"
                   class="btn btn-primary btn-lg mb-2 mb-lg-0 px-4 py-3 me-md-4 me-lg-4 px-5 text-uppercase rounded-pill shadow">
                    Sign Up
                </a>
                <a href="{{ route('login') }}"
                   class="btn bg-white text-dark btn-lg mb-2 mb-lg-0 py-3 px-5 text-uppercase rounded-pill shadow">Login</a>
            @else
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 user_profile_toggle">
                    <x-dropdown class="user-profile">
                        <x-slot name="trigger" class="">
                            <span class="fs-16 fw-500 ms-2" style="word-spacing: 4px;">
                                <div class="d-inline-block">
                                    @if(isset(Auth::user()->profile_photo_path))
                                        <img class="rounded-circle" width="50" height="50"
                                             style="filter: grayscale(0);object-fit: cover !important;"
                                             src="{{ Auth::user()->profile_photo_url }}"/>
                                    @else
                                        <span
                                            class="text-uppercase rounded-circle d-flex justify-content-center align-items-center bg-primary-lighter
                                             text-white text-center fw-500 fs-20 me-2"
                                            style="height: 45px; width: 45px">
                                            {{Str::limit(Auth::user()->first_name, 2, '')}}
                                        </span>
                                    @endif
                                </div>
                                {{ Auth::user()->first_name }}
                            </span>
                        </x-slot>
                        <x-slot name="content" class="userUlList">

                            @php
                                $checkGuestRoute = request()->routeIs('guest.index') || request()->routeIs('guest.demo') || request()->routeIs('guest.blog') || request()->routeIs('guest.about') || request()->routeIs('guest.contact');
                            @endphp

                            @if($checkGuestRoute)

                                <x-dropdown-link href="{{ route('dash.offer-forms.index') }}">
                                    OfferForms
                                </x-dropdown-link>

                            @else
                                <x-dropdown-link href="{{ route('dash.settings') }}">
                                    Account
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                 this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </ul>
            @endguest
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        $('.pricingSectionBtn').click(function () {
            if (location.hash == "#pricingSection") {
                $('html, body').animate({
                    scrollTop: $(".pricingSection").offset().top
                }, 1000);
            }
        });
    </script>
@endpush

