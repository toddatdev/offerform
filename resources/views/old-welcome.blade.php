<x-guest-layout>

    @push('stylesheets')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">

        <style>

            body {
                overflow-x: hidden !important;
            }

            video {
                width: 100% !important;
            }

            .how-it-works p {
                font-size: 22px;
                font-weight: normal;
                margin: 12px 0;
            }

            .stepRotate {
                -ms-transform: rotate(-90deg); /* IE 9 */
                transform: rotate(-90deg);
            }

            .stepRotateNumber {
                -ms-transform: rotate(0deg); /* IE 9 */
                transform: rotate(0deg);
            }

            .agent-section p {
                font-size: 22px;
                font-weight: normal;
                margin: 12px 0;
            }

            .agent-section ul li {
                font-size: 18px;
                color: #7b2dbf;
                font-weight: bold;
            }

            .how-it-works ul li {
                font-size: 18px;
                color: #7b2dbf;
                font-weight: bold;
            }

            b, strong {
                color: #7b2dbf;
            }

            .slick-slider {
                width: 100%;
                background-color: transparent;
            }

            .slick-track {
                display: flex;
                align-items: center;
                flex-wrap: nowrap;
                height: 200px;
                justify-content: center;
            }

            .slick-slide {
                float: none;
                display: inline-block;
                vertical-align: middle;
                padding: 10px 0px;
                margin: 10px;
                background-color: transparent;
                transition: all 0.3s ease;
                height: auto;
                text-align: center;
            }

            .slick-center {
                width: 250px !important;
                height: 250px !important;
                padding-top: 40px;
            }

            .slick-prev,
            .slick-next {
                z-index: 10;
                top: 120px;
                color: #00000030 !important;
            }

            .slick-prev:before, .slick-next:before {
                font-size: 50px;
                box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%) !important;
                border-radius: 50%;
                padding: 25px;
                background-color: #ffffff;
            }

            .slick-slider .slick-prev:before {

                {{--background-image: url('{{asset('img/menu-icons/arrow-right.svg')}}');--}}
                   background-image: url('{{asset('img/menu-icons/arrow-left.svg')}}');
                background-size: 12px;
                display: inline-block;
                width: 50px;
                height: 50px;
                background-repeat: no-repeat;
                transform: rotate(180deg);
                content: "";
                background-position: center;
                filter: grayscale(100%);
            }

            .slick-slider .slick-next:before {
                background-image: url('{{asset('img/menu-icons/arrow-left.svg')}}');
                background-size: 12px;
                display: inline-block;
                width: 50px;
                height: 50px;
                background-repeat: no-repeat;
                content: "";
                background-position: center;
                filter: grayscale(100%);

            }

            .slick-slider .slick-prev:hover {
                filter: grayscale(0%);
            }

            .slick-slider .slick-next:hover {
                filter: grayscale(0);
            }

            .slick-prev {
                left: -80px !important;
            }

            .slick-next {
                right: -50px !important;
            }

            .slick-slider-description .slick-prev {
                z-index: 10;
                top: -85px;
                color: #00000030 !important;
            }

            .slick-slider-description .slick-next {
                z-index: 10;
                top: -85px;
                color: #00000030 !important;
            }

            .slick-slider-description .slick-next {
                display: none !important;
            }

            .slick-slider-description .slick-prev {
                display: none !important;
            }

            @media (max-width: 576px) {

                .slick-prev {
                    left: 170px !important;
                    top: -20px !important;
                }

                .slick-next {
                    right: 35px !important;
                    top: -20px !important;
                }
            }
        </style>

    @endpush
    <div class="container my-5 py-2 py-lg-5 home-page">
        <div class="row pb-5 hero-section">
            <div class="col-12 col-md-6 col-lg-5 align-self-center" data-aos="fade-up">
                <h1 class="h1 fw-lighter" style="color: #3a3a3a">{{$homes->hero_title ?? 'Write Better Offers'}}</h1>
                <h2 class="fw-bold my-3" style="color: #3a3a3a">
                    {{$homes->hero_short_description ?? 'Gathering offer information is as easy as sending a link.'}}
                </h2>
                <p class="fs-17">{!! $homes->hero_description ?? 'Spend less time gathering offer info, eliminate contract mistakes, and look more professional to your buyers.' !!}</p>
                <div class="text-center mb-3">
                    <form class="input-group mt-4" action="{{ route('register') }}">
                        <x-input type="text" class="form-control form-control-lg text-center"
                                 name="email"
                                 placeholder="Enter your email"/>
                        <button class="btn btn-primary px-1 px-lg-4 text-uppercase"
                                style="border-top-right-radius: 15px;border-bottom-right-radius: 15px" type="submit">
                            Create Free Account
                        </button>
                    </form>
                </div>
                <p class="fs-18 fw-bold">{{$homes->hero_bottom_description ?? '100% free forever! No credit card needed.'}}</p>
            </div>

            <div class="col-12 col-md-6 col-lg-7" data-aos="zoom-in" data-aos-delay="400">
                <div class="card shadow">
                    <img class="img-fluid"
                         src="{{isset($homes->hero_image) ? asset('storage/' . $homes->hero_image) : asset('img/guest/home/hero-img.jpg')}}"
                         alt="">
                </div>
            </div>
        </div>
    </div>


    <div class="w-100 py-4 here-is-what-we-do"
         style="background-image: url('/img/guest/home/bg-video-back-img.png');background-size: cover;background-repeat: no-repeat;background-position: center;">
        <div
            class="container position-relative row w-75 mx-auto d-flex align-items-center video-h-75 justify-content-center align-self-center"
        >
            <div>
                <h1 class="h1 text-center text-white"
                    data-aos="fade-up">{{$homes->section_one_title ?? 'Here’s what we do in 60 seconds'}}</h1>

                <!-- Button trigger modal -->
                <button type="button" class="video-btn bg-transparent p-0 border-0" style="width: 0px"
                        data-bs-toggle="modal"
                        data-src="{{isset($homes->section_one_video_link) ? asset('storage/' . $homes->section_one_video_link) : asset('img/guest/home/more_benefit_fig2.png')}}"
                        data-bs-target="#myModal">
                    <img style="width: 250px;bottom: 40px;right: 190px;" class="position-absolute video-play-icon-home-page"
                         src="{{asset('img/guest/home/play-lg.png')}}" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="btn-modal" data-bs-dismiss="modal" aria-label="Close"></span>X</button>
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9    ">
                        <iframe class="embed-responsive-item"
                                width="100%" height="100%"
                                src=""
                                sandbox=""
                                id="video" allowscriptaccess="always"
                                allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    How it Works--}}

    <div class="container my-5 how-it-works">
        <h1 class="text-center h1" data-aos="fade-up">{{$homes->how_it_works_title ?? 'How it Works'}}</h1>

        {{--        how work row--}}
        <div class="row my-5">
            <div class="col-12 col-lg-6 mb-3 mb-lg-0 align-self-center" data-aos="fade-right">
                <div class="d-flex justify-content-start ">
                    <div class="step step-number p-3 rounded-circle align-self-center">
                        <h3 class="text-uppercase text-stem text-white stepRotate">STEP</h3><span
                            class="stepRotateNumber text-white fs-32 fw-bold"> 1</span>
                    </div>
                    <div class=" mx-5 align-self-center">
                        <h1 class="fw-bold">{{$homes->sec_one_step_first_title ?? 'Send a Link'}}</h1>
                    </div>
                </div>
                {!! $homes->sec_one_step_first_desc ?? 'Send your buyer your OfferForm link VIA text or email.
 We keep (you) the agent involved throughout every step of the process. With your branding and contact info on every page, your always just a click away.' !!}
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-0" data-aos="fade-left">
                <img class="img-fluid"
                     src="{{isset($homes->sec_one_step_first_image) ? asset('storage/' . $homes->sec_one_step_first_image) : asset('img/guest/home/how-work1.png')}}"
                     alt="">
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12 col-lg-6 mb-3 order-2 order-lg-1 mb-lg-0" data-aos="fade-left">
                <img class="img-fluid"
                     src="{{isset($homes->sec_one_step_second_image) ? asset('storage/' . $homes->sec_one_step_second_image) : asset('img/guest/home/how-work2.png')}}"
                     alt="">
            </div>
            <div class="col-12 col-lg-6 mb-3 order-1 order-lg-2 mb-lg-0 align-self-center" data-aos="fade-right">
                <div class="d-flex justify-content-start ">
                    <div class="step step-number p-3 rounded-circle align-self-center">
                        <h3 class="text-uppercase text-stem text-white stepRotate">STEP</h3><span
                            class="stepRotateNumber text-white fs-32 fw-bold"> 2</span>
                    </div>
                    <div class=" mx-5 align-self-center">
                        <h1 class="fw-bold">{{$homes->sec_one_step_second_title ?? 'Send a Link'}}</h1>
                    </div>
                </div>
                {!! $homes->sec_one_step_second_desc ?? 'Send your buyer your OfferForm link VIA text or email.
 We keep (you) the agent involved throughout every step of the process. With your branding and contact info on every page, your always just a click away.' !!}

            </div>
        </div>
        <div class="row my-5">
            <div class="col-12 col-lg-6 mb-3 mb-lg-0 align-self-center" data-aos="fade-right">
                <div class="d-flex justify-content-start ">
                    <div class="step step-number p-3 rounded-circle align-self-center">
                        <h3 class="text-uppercase text-stem text-white stepRotate">STEP</h3><span
                            class="stepRotateNumber text-white fs-32 fw-bold"> 3</span>
                    </div>
                    {{--                    <div class="step step-number p-3 rounded-circle align-self-center">--}}
                    {{--                        <h3 class="text-uppercase text-stem text-white stepRotate">STEP</h3><span class="stepRotateNumber text-white fs-32 fw-bold"> 3</span>--}}
                    {{--                    </div>--}}
                    <div class=" mx-5 align-self-center">
                        <h1 class="fw-bold">{{$homes->sec_one_step_third_title ?? 'Buyer fills out form'}}</h1>
                    </div>
                </div>
                {!! $homes->sec_one_step_third_desc ?? 'Send your buyer your OfferForm link VIA text or email.
We keep (you) the agent involved throughout every step of the process. With your branding and contact info on every page, your always just a click away.' !!}

            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-0" data-aos="fade-left">
                <img class="img-fluid"
                     src="{{isset($homes->sec_one_step_third_image) ? asset('storage/' . $homes->sec_one_step_third_image) : asset('img/guest/home/how-work3.png')}}"
                     alt="">
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12 col-lg-6 mb-3 mb-lg-0 order-2 order-lg-1" data-aos="fade-left">
                <img class="img-fluid"
                     src="{{isset($homes->sec_one_step_fourth_image) ? asset('storage/' . $homes->sec_one_step_fourth_image) : asset('img/guest/home/how-work4.png')}}"
                     alt="">
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-0 align-self-center order-1 order-lg-2" data-aos="fade-right">
                <div class="d-flex justify-content-start ">
                    <div class="step step-number p-3 rounded-circle align-self-center">
                        <h3 class="text-uppercase text-stem text-white stepRotate">STEP</h3><span
                            class="stepRotateNumber text-white fs-32 fw-bold"> 4</span>
                    </div>
                    <div class=" mx-5 align-self-center">
                        <h1 class="fw-bold">{{$homes->sec_one_step_fourth_title ?? 'Send a Link'}}</h1>
                    </div>
                </div>
                {!! $homes->sec_one_step_fourth_desc ?? 'Send your buyer your OfferForm link VIA text or email.
We keep (you) the agent involved throughout every step of the process. With your branding and contact info on every page, your always just a click away.' !!}
            </div>
        </div>

    </div>


    {{--    Used by These Top Brokerages--}}

    {{--    <div class="container-fluid Brokerages my-5">--}}
    {{--        <h1 class="text-center h1 py-5"--}}
    {{--            data-aos="fade-up">{{$homes->brokerage_title ?? 'Used by These Top Brokerages'}}</h1>--}}
    {{--        <div class="row px-5 my-5">--}}
    {{--            <div class="col-6 col-lg-3 my-3 text-center" data-aos="fade-right">--}}
    {{--                <img class="img-fluid"--}}
    {{--                     src="{{isset($homes->brokerage_first_image) ? asset('storage/' . $homes->brokerage_first_image) : asset('img/guest/home/brokerage_logo1.png')}}"--}}
    {{--                     alt="">--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-lg-3 my-3 text-center" data-aos="fade-right">--}}
    {{--                <img class="img-fluid"--}}
    {{--                     src="{{isset($homes->brokerage_second_image) ? asset('storage/' . $homes->brokerage_second_image) : asset('img/guest/home/brokerage_logo2.png')}}"--}}
    {{--                     alt="">--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-lg-3 my-3 text-center" data-aos="fade-right">--}}
    {{--                <img class="img-fluid"--}}
    {{--                     src="{{isset($homes->brokerage_third_image) ? asset('storage/' . $homes->brokerage_third_image) : asset('img/guest/home/brokerage_logo3.png')}}"--}}
    {{--                     alt="">--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-lg-3 my-3 text-center" data-aos="fade-right">--}}
    {{--                <img class="img-fluid"--}}
    {{--                     src="{{isset($homes->brokerage_fourth_image) ? asset('storage/' . $homes->brokerage_fourth_image) : asset('img/guest/home/brokerage_logo4.png')}}"--}}
    {{--                     alt="">--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    {{--    Why Agent’s Use Index--}}

    <div class="agents agent-section container my-5">
        <h1 class="text-center h1 py-2 py-lg-5 "
            data-aos="fade-up">{{$homes->agent_title ?? 'Why Agent’s Use OfferForm'}}</h1>

        <div class="row px-5 my-5">
            <div class="col-12 col-lg-5 mb-3 mb-lg-0 align-self-center" data-aos="fade-right">
                <img class="img-fluid icon-img"
                     src="{{isset($homes->agent_sec_first_icon) ? asset('storage/' . $homes->agent_sec_first_icon) : asset('img/guest/home/more_benefit_fig2.png')}}"
                     alt="">
                <h2 class="fw-bolder my-5">{{$homes->agent_sec_first_title ?? 'Real Time Mortgage and Closing Costs Calculator'}}</h2>

                {!! $homes->agent_sec_first_des ?? ' A built in mortgage calculator shows your buyers their monthly payment based on their offer. Paired
                    with a closing costs calculator that gives them an estimate on their closing costs.' !!}
            </div>
            <div class="col-12 col-lg-7 mb-3 mb-lg-0 align-self-center" data-aos="fade-right">
                <img class="img-fluid"
                     src="{{isset($homes->agent_sec_first_image) ? asset('storage/' . $homes->agent_sec_first_image) : asset('img/guest/home/agent_ofcfrm_img2.png')}}"
                     alt="">
            </div>
        </div>

        <div class="row px-5 my-5">
            <div class="col-12 col-lg-7 mb-3 mb-lg-0 order-2 order-lg-1  align-self-center" data-aos="fade-right">
                <img class="img-fluid"
                     src="{{isset($homes->agent_sec_second_image) ? asset('storage/' . $homes->agent_sec_second_image) : asset('img/guest/home/agent_ofcfrm_img3.png')}}"
                     alt="">
            </div>
            <div class="col-12 col-lg-5 mb-3 mb-lg-0 order-1 order-lg-2 align-self-center" data-aos="fade-left">
                <img class="img-fluid icon-img"
                     src="{{isset($homes->agent_sec_second_icon) ? asset('storage/' . $homes->agent_sec_second_icon) : asset('img/guest/home/more_benefit_fig3.png')}}"
                     alt="">
                <h2 class="fw-bolder my-5">{{$homes->agent_sec_second_title ?? 'Real Time Mortgage and Closing Costs Calculator'}}</h2>

                {!! $homes->agent_sec_second_des ?? ' A built in mortgage calculator shows your buyers their monthly payment based on their offer. Paired
                    with a closing costs calculator that gives them an estimate on their closing costs.' !!}
            </div>
        </div>

        <div class="row px-5 my-5">
            <div class="col-12 col-lg-5 mb-3 mb-lg-0 align-self-center" data-aos="fade-left">
                <img class="img-fluid icon-img"
                     src="{{isset($homes->agent_sec_third_icon) ? asset('storage/' . $homes->agent_sec_third_icon) : asset('img/guest/home/more_benefit_fig4.png')}}"
                     alt="">
                <h2 class="fw-bolder my-5">{{$homes->agent_sec_third_title ?? 'Real Time Mortgage and Closing Costs Calculator'}}</h2>

                {!! $homes->agent_sec_third_des ?? ' A built in mortgage calculator shows your buyers their monthly payment based on their offer. Paired
                    with a closing costs calculator that gives them an estimate on their closing costs.' !!}
            </div>
            <div class="col-12 col-lg-7 mb-3 mb-lg-0 align-self-center" data-aos="fade-right">
                <img class="img-fluid"
                     src="{{isset($homes->agent_sec_third_image) ? asset('storage/' . $homes->agent_sec_third_image) : asset('img/guest/home/agent_ofcfrm_img4.png')}}"
                     alt="">
            </div>
        </div>

    </div>

    {{--    Testimonial--}}

    <div class="my-5 py-3">
        @if(!$testimonials->isEmpty())

            <h1 class="text-center h1" data-aos="fade-up">Agent Testimonials</h1>
            <div class="py-3 bg-light">
                <div class="container"
                     style="background-image: url('img/guest/home/testimonial/map.png');background-size: cover;background-repeat: no-repeat;background-position: center">

                    <h5 class="my-5 fw-bold text-center pt-3" data-aos="fade-up">Trusted by agents all around the
                        world!</h5>

                    <div class="slick-slider w-full-md-75 mx-auto py-2 align-self-center">
                        @foreach($testimonials as $testimonial)
                            <div class="align-self-center align-items-center">
                                <img class="w-75 mx-auto rounded-circle"
                                     src="{{ URL::asset('storage/' . $testimonial->image) }}"
                                     alt="">
                            </div>
                        @endforeach
                    </div>

                    <div class="slick-slider-description w-full-md-75 mx-auto align-self-center">
                        @foreach($testimonials as $testimonial)
                            <div class=" text-center align-self-center align-items-center bg-transparent">
                                <p>
                                    {!! $testimonial->comment !!}
                                </p>
                                <p class="text-primary fw-bold fs-14 mb-0 ">{{$testimonial->name}}</p>
                                <p class="fs-6">{{$testimonial->location}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{--    Pricing Plan Save up to 20%    --}}
    <div class="container mt-5 mb-100 pricing pricingSection " id="pricingSection">

        @auth

            @role('agent')

            <livewire:profile.agent.subscription-form :user="auth()->user()"/>

            @endrole

        @else

            {{-- Guest User--}}

            <div class="text-center row">
                <h1 class="h1" data-aos="fade-up">Pricing Plan</h1>
                <h5>Choose the plan that's right for your growing team!</h5>
                <div class="inner col-12 mx-auto tabsBtnHolder my-4 pb-5 ">
                    <div class="btn-group bg-primary rounded-pill px-0 shadow mb-2"
                         role="group"
                         aria-label="Basic example">
                        <button id="monthly"
                                type="button"
                                class="active btn subscription  px-5 text-white py-3 rounded-pill text-uppercase">
                            Monthly
                        </button>
                        <button
                            id="yearly"
                            type="button"
                            data-bs-html="true"
                            data-bs-toggle="tooltip" data-bs-placement="right"
                            title="<span class='fs-20 px-3 py-2 d-inline-block'>Save up to 20%</span>"
                            class="btn rounded-pill subscription text-white px-5 py-3 btnYearlyTooltip">
                            Yearly
                        </button>
                    </div>
                </div>
            </div>

            <div class="row monthlyPriceList animated my-5 py-3">
                <div class="col-12 col-lg-4 px-4 my-5 my-lg-0 mx-auto">
                    <div class="col mx-2 py-4" style="background-color: #5a1e9a;min-height: 810px">
                        <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0 " style="min-height: 810px">
                            <div class="card-body">
                                <div class="" style="height: 100px">
                                    <h4 class="text-primary fw-bold">$0 <span class="fs-14 text-dark">/month</span>
                                    </h4>
                                    <h4 class="text-uppercase text-center fw-500 mb-0">Free plan</h4>
                                    {{--                                <p>NO CREDIT CARD REQUIRED</p>--}}
                                </div>
                                <hr>
                                {{--  free plan--}}
                                <ul class="list-group list-group-flush pb-4 px-3">
                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Unlimited OfferForms</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Premade Offer Form templates</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Premade animated explainer videos for your buyers</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark "> Real-time mortgage and closing cost calculator</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Integration with Zapier</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Text and Email OfferForms directly from the system</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Custom Form Builder</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Personalize your own Educational Videos</a>
                                    </li>

                                    {{--                <li class="list-group-item border-0">--}}
                                    {{--                    <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>--}}
                                    {{--                    <a href="#" class="text-decoration-none text-dark ">Team form sharing</a>--}}
                                    {{--                </li>--}}

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-dark p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none light-dark" >Use your own referral partners</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-dark p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none light-dark" >No Locked Steps</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        @guest
                            <div class="mt-4">
                                <a href="{{route('register')}}"
                                   class="fw-bold text-uppercase text-white text-decoration-none px-3">
                                    Get Started
                                    <span class="mx-2">
                                            <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                                    </span>
                                </a>
                            </div>
                        @endguest
                    </div>
                    @auth
                        <div class="mt-4 text-center">
                            <a href="{{route('agent.settings')}}#pricing"
                               class="btn text-white w-210 btn-lg btn-light-gradient btn-header rounded-pill fw-bold text-uppercase fs-14"
                               style="">
                                Your Current plan
                            </a>
                        </div>
                    @endauth

                </div>
                <div class="col-12 col-lg-4 px-4 my-5 my-lg-0 mx-auto">
                    <div class="col mx-2 py-4" style="background-color: #786ade;min-height: 810px">
                        <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0" style="min-height: 810px" >
                            <div class="card-body">
                                <div class="" style="height: 100px">
                                    <h4 class="text-primary fw-bold">$10 <span class="fs-14 text-dark">/month</span>
                                    </h4>
                                    <h4 class="text-uppercase fw-500 mb-0 text-center">PREMIUM PLAN</h4>
                                </div>
                                <hr>
                                {{--  Preminum plan--}}
                                <ul class="list-group list-group-flush pb-4 px-3">
                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Unlimited OfferForms</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Premade Offer Form templates</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Premade animated explainer videos for your buyers</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark "> Real-time mortgage and closing cost calculator</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Integration with Zapier</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Text and Email OfferForms directly from the system</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Custom Form Builder</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Personalize your own Educational Videos</a>
                                    </li>

                                    {{--                <li class="list-group-item border-0">--}}
                                    {{--                    <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>--}}
                                    {{--                    <a href="#" class="text-decoration-none text-dark ">Team form sharing</a>--}}
                                    {{--                </li>--}}

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Use your own referral partners</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">No Locked Steps</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        @guest
                            <div class="mt-4">
                                <a href="{{route('register')}}"
                                   class="fw-bold text-uppercase text-white text-decoration-none px-3">
                                    Get Started
                                    <span class="mx-2">
                                            <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                                    </span>
                                </a>
                            </div>
                        @endguest
                    </div>
                    @auth
                        <div class="mt-4 text-center">
                            <a href="{{route('agent.settings')}}#pricing"
                               class="btn text-white w-210 btn-lg btn-light-gradient btn-header rounded-pill fw-bold text-uppercase fs-14"
                               style="">
                                upgrade to premium
                            </a>
                        </div>
                    @endauth

                </div>
            </div>

            <div class="row yearlyPriceList d-none animated my-5 py-3">
                <div class="col-12 col-lg-4 px-4 my-5 my-lg-0 mx-auto">
                    <div class="col mx-2 py-4" style="background-color: #5a1e9a;min-height: 810px" >
                        <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0" style="min-height: 810px">
                            <div class="card-body">
                                <div class="" style="height: 100px">
                                    <h4 class="text-primary fw-bold">$0 <span class="fs-14 text-dark">/year</span>
                                    </h4>
                                    <h4 class="text-uppercase fw-500 mb-0 text-center">Free plan</h4>
                                    {{--                                <p>NO CREDIT CARD REQUIRED</p>--}}
                                </div>
                                <hr>
                                {{--  free plan--}}
                                <ul class="list-group list-group-flush pb-4 px-3">
                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Unlimited OfferForms</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Premade Offer Form templates</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Premade animated explainer videos for your buyers</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark "> Real-time mortgage and closing cost calculator</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Integration with Zapier</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Text and Email OfferForms directly from the system</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Custom Form Builder</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Personalize your own Educational Videos</a>
                                    </li>

                                    {{--                <li class="list-group-item border-0">--}}
                                    {{--                    <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>--}}
                                    {{--                    <a href="#" class="text-decoration-none text-dark ">Team form sharing</a>--}}
                                    {{--                </li>--}}

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-dark p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none light-dark" >Use your own referral partners</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-dark p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none light-dark" >No Locked Steps</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        @guest
                            <div class="mt-4">
                                <a href="{{route('register')}}"
                                   class="fw-bold text-uppercase text-white text-decoration-none px-3">
                                    Get Started
                                    <span class="mx-2">
                                            <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                                    </span>
                                </a>
                            </div>
                        @endguest
                    </div>
                    @auth
                        <div class="mt-4 text-center">
                            <a href="{{route('agent.settings')}}#pricing"
                               class="btn text-white w-210 btn-lg btn-light-gradient btn-header rounded-pill fw-bold text-uppercase fs-14"
                               style="">
                                Your Current plan
                            </a>
                        </div>
                    @endauth
                </div>
                <div class="col-12 col-lg-4 px-4 my-5 my-lg-0 mx-auto">
                    <div class="col mx-2 py-4" style="background-color: #786ade;min-height: 810px">
                        <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0" style="min-height: 810px">
                            <div class="card-body">
                                <div class="" style="height: 100px">
                                    <h4 class="text-primary fw-bold">$120 <span class="fs-14 text-dark">/year</span>
                                    </h4>
                                    <h4 class="text-uppercase fw-500 mb-0 text-center">PREMIUM PLAN</h4>
                                </div>

                                <hr>
                                {{--  Preminum plan--}}
                                <ul class="list-group list-group-flush pb-4 px-3">
                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Unlimited OfferForms</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Premade Offer Form templates</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Premade animated explainer videos for your buyers</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark "> Real-time mortgage and closing cost calculator</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Integration with Zapier</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Text and Email OfferForms directly from the system</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Custom Form Builder</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Personalize your own Educational Videos</a>
                                    </li>

                                    {{--                <li class="list-group-item border-0">--}}
                                    {{--                    <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>--}}
                                    {{--                    <a href="#" class="text-decoration-none text-dark ">Team form sharing</a>--}}
                                    {{--                </li>--}}

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">Use your own referral partners</a>
                                    </li>

                                    <li class="list-group-item border-0">
                                        <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                        <a href="#" class="text-decoration-none text-dark ">No Locked Steps</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        @guest
                            <div class="mt-4">
                                <a href="{{route('register')}}"
                                   class="fw-bold text-uppercase text-white text-decoration-none px-3">
                                    Get Started
                                    <span class="mx-2">
                                            <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                                    </span>
                                </a>
                            </div>
                        @endguest
                    </div>
                    @auth
                        <div class="mt-4 text-center">
                            <a href="{{route('agent.settings')}}#pricing"
                               class="btn text-white w-210 btn-lg btn-light-gradient btn-header rounded-pill fw-bold text-uppercase fs-14"
                               style="">
                                Upgrade to premium
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <div class="my-4 pricing">
                <div class="text-center row mb-5 pb-5">
                    <h1 class="">
                        <img class="me-2" data-aos="fade-up" width="42" src="{{asset('img/menu-icons/fluent-people-team.svg')}}" alt="">Change to a Team Plan</h1>
                    <h5>Share Forms Amongst Your Team</h5>
                </div>
                <div class="row animated my-5 py-3">
                    <div class="col-12 col-lg-4 px-4 my-4 my-lg-0 mx-auto">
                        <div class="col mx-2 py-4" style="background-color: #DDC3F2">
                            <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0 ">
                                <div class="card-body">
                                    <div class="" style="height: 125px">
                                        <h3 class="text-primary text-center mb-3">$0 <span class="fs-14 text-dark">/month per user</span>
                                        </h3>
                                        <h3 class="text-uppercase fw-500 text-center">FREE TEAM/BROKERAGE PLAN</h3>
                                    </div>
                                    <hr>

                                    <ul class="list-group list-group-flush pb-4 px-3">
                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark ">Unlimited OfferForms</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark ">Premade Offer Form templates</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark ">Premade animated explainer videos for your buyers</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "> Real-time mortgage and closing cost calculator</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark ">Integration with Zapier</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark ">Text and Email OfferForms directly from the system</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark ">Custom Form Builder</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark ">Personalize your own Educational Videos</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark ">Team form sharing</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-dark p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none light-dark" >Use your own referral partners</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-dark p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none light-dark"  >No Locked Steps</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{route('register')}}"
                                   class="fw-bold text-uppercase text-white text-decoration-none px-3">
                                    Get Started
                                    <span class="mx-2">
                                            <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                                    </span>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-4 px-4 my-4 my-lg-0 mx-auto">
                        <div class="col mx-2 py-4" style="background-color: #D5B6ED">
                            <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0 ">
                                <div class="card-body">
                                    <div class="mb-3" style="height: 125px">
                                        <h3 class="text-primary text-center mb-3">$ Varies <span class="fs-14 text-dark">/month per user</span></h3>
                                        <h3 class="text-uppercase fw-500 text-center"> PREMIUM TEAM/BROKERAGE PLAN</h3>
                                    </div>
                                    <hr>
                                    <ul class="list-group list-group-flush pb-4 px-3">
                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me>Unlimited OfferForms</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me>Premade Offer Form templates</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me>Premade animated explainer videos for your buyers</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me> Real-time mortgage and closing cost calculator</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me>Integration with Zapier</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me>Text and Email OfferForms directly from the system</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me>Custom Form Builder</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me>Personalize your own Educational Videos</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me>Team form sharing</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me>Use your own referral partners</a>
                                        </li>

                                        <li class="list-group-item border-0">
                                            <span class="fa-li"><i class="fa fa-check text-primary p-1 rounded-circle"></i></span>
                                            <a href="#" class="text-decoration-none text-dark "me>No Locked Steps</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{route('register')}}"
                                   class="fw-bold text-uppercase text-white text-decoration-none px-3">
                                    Get Started
                                    <span class="mx-2">
                                            <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        @endauth

    </div>

    @push('scripts')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>

        <script>
            $(document).ready(function () {
                $('.slick-slider').slick({
                    centerMode: true,
                    centerPadding: '10px',
                    @if(count($testimonials) == 1)
                    slidesToShow: 1,
                    @elseif(count($testimonials) == 2)
                    slidesToShow: 1,
                    @elseif(count($testimonials) == 3)
                    slidesToShow: 1,
                    @elseif(count($testimonials) == 4)
                    slidesToShow: 3,
                    @else
                    slidesToShow: 5,
                    @endif
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: true,
                                centerMode: true,
                                centerPadding: '20px',
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                arrows: true,
                                centerMode: true,
                                centerPadding: '20px',
                                slidesToShow: 1
                            }
                        }
                    ]
                });

                $('.slick-slider-description').slick({
                    dots: false,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                    adaptiveHeight: true
                });
            });

        </script>

        <script>
            $(document).ready(function () {
                var $videoUrl;
                $('.video-btn').click(function () {
                    $videoUrl = $(this).data("src");
                });
                console.log($videoUrl);
// when the modal is opened autoplay it
                $('#myModal').on('shown.bs.modal', function (e) {
// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
                    $("#video").attr('src', $videoUrl + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
                })

// stop playing the youtube video when I close the modal
                $('#myModal').on('hide.bs.modal', function (e) {
                    // a poor man's stop video
                    $("#video").attr('src', $videoUrl);
                })


                $(".subscription").click(function () {
                    // remove classname 'active' from all li who already has classname 'active'
                    $(".subscription.active").removeClass("active");
                    // adding classname 'active' to current click li
                    $(this).addClass("active");
                });

                // Subscriptions

                $("#monthly").click(function () {
                    $(this).addClass('active');
                    $("#yearly").removeClass('active')

                    $(".monthlyPriceList").removeClass('d-none');
                    $(".monthlyPriceList").addClass('fadeIn');
                    $(".yearlyPriceList").addClass('d-none');

                    $(".indicator").css("left", "2px");
                })

                $("#yearly").click(function () {
                    $(this).addClass('active');
                    $("#monthly").removeClass('active');

                    $(".yearlyPriceList").removeClass('d-none');
                    $(".yearlyPriceList").addClass('fadeIn');
                    $(".monthlyPriceList").addClass('d-none');

                    $(".indicator").css("left", "163px");
                })

                //Trigger buttons on click slick

                $(".slick-slider .slick-next ").click(function () {
                    $(".slick-slider-description .slick-next").trigger('click');
                    return false;
                });

                $(".slick-slider .slick-prev ").click(function () {
                    $(".slick-slider-description .slick-prev").trigger('click');
                    return false;
                });

            });
        </script>

        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>

    @endpush
</x-guest-layout>
