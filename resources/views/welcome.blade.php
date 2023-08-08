<x-guest-layout>

    @push('stylesheets')

        {{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">--}}
        {{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">--}}
        <link rel="stylesheet" href="{{asset('v1.1/css/style.css')}}" />

        <style>

            body {
                overflow-x: hidden !important;
            }
            video {
                width: 100% !important;
            }
            .rounded-background {
                width: 145px;
                height: 135px;
                background: linear-gradient(89.7deg, #7526B1 0.18%, rgba(117, 38, 177, 0) 187.01%);
            }



            @media only screen and (min-width:992px){
                .section-1{
                    margin-top:200px !important;
                }
            }
            @media only screen and (min-width:768px) and (max-width:991px){
                .section-1{
                    margin-top:100px !important;
                }
                .fs-20{
                    font-size:15px !important;
                }
            }
            @media only screen and (min-width:1440px){
                .vh-80 {
                    height: 80vh !important;
                }
            }

            @media only screen and (max-width:375px){
                .fs-mobile p{
                    font-size:14px !important;
                }
                .fs-mobile{
                    font-size:14px !important;
                }
            }
        </style>
    @endpush

    {{--    <section class="hero-section vh-100-lg-75 d-flex justify-content-center align-items-center">--}}
    {{--        <div class="container py-3">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-12 col-lg-5  mb-3 mb-lg-0">--}}
    {{--                    <h2 class="fw-bold h2 lh-50">Transforming the <br/> Realtor-Client<br/> relationship though</h2>--}}
    {{--                    <h2 class="fw-bold text-primary-light h2 my-3">Video education</h2>--}}
    {{--                    <p class="mb-5">Streamlining the offer process while ensuring all home buyers have a fair and equal opportunity to buy a home. </p>--}}

    {{--                    <div class="d-grid gap-2 d-md-block">--}}
    {{--                        <a href="{{route('register')}}" class="btn btn-primary-light-black-hover text-uppercase w-210 fw-500 rounded-pill me-3" >Sign up</a>--}}
    {{--                        <a href="{{route('guest.demo')}}" class="btn btn-primary-light-black-hover text-uppercase w-210 fw-500 rounded-pill me-3">Request Demo</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-12 col-lg-7 mb-3 mb-lg-0">--}}
    {{--                    <div class="col-inner bg-img rounded-15 h-380" style="background-image: url({{asset('v1.1/images/header-bg.png')}})">--}}
    {{--                        <div class="text-center text-white h-380 d-flex justify-content-center align-items-center">--}}
    {{--                           <div>--}}
    {{--                               <h3>OfferForm in 60 seconds</h3>--}}
    {{--                               <a class="" href="">--}}
    {{--                                   <img class="my-4" src="{{asset('v1.1/images/play-btn.svg')}}" alt="">--}}
    {{--                               </a>--}}
    {{--                               <h4>Click Play to learn more</h4>--}}
    {{--                           </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

    <header>
        <div class="container vh-80 d-flex justify-content-center pt-5 align-items-center">
            <div class="row header-sec">
                <div class="col-lg-5 mb-3 mb-lg-0">
                    <div>
                        <h1 class="h1 lh-50 font-poppins text-center text-lg-start">{{$homes->hero_title ?? 'Transforming the Realtor-Client relationship though'}}</h1>
                        <p class="font-poppins mb-0 color-purple fw-bold text-center text-lg-start py-2 fs-30-sm-20"
                        >&nbsp;<span style="margin-left: -5px" id="sliderText">{{$homes->hero_sub_title ?? 'Video Education'}}</span></p>
                    </div>
                    <div class="font-poppins-light fs-5 text-center text-lg-start">
                        {!! $homes->hero_description ?? 'Streamlining the offer process while ensuring all home buyers have a fair and equal opportunity to buy a home.' !!} </div>
                    <div class="d-grid gap-2 d-md-block mt-3 text-center text-lg-start">
                        <a href="{{route('register')}}" class="btn btn-primary-light-black-hover mb-md-2 text-uppercase w-210 fw-500 rounded-pill me-3" >Sign up</a>
                        <a href="{{route('guest.demo')}}" class="btn btn-primary-light-black-hover mb-md-2 text-uppercase w-210 fw-500 rounded-pill me-3">Request Demo</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div>
                        <div class="card text-white bg-transparent border-0 text-center">
                            <img src="{{isset($homes->hero_image) ? asset('storage/' . $homes->hero_image) : asset('v1.1/images/header-bg.png')}}" class="card-img" alt="...">
                            <div class="card-img-custom-overlay d-grid align-items-center h-100">
                                <h5 class="card-title fs-2"><span class="d-none d-lg-block">OfferForm in 60
                                        seconds</span></h5>
                                <a href="#"
                                   data-bs-toggle="modal" data-bs-target="#headerVideo"
                                ><img src="{{asset('v1.1/images/play-btn.svg')}}" class="img-fluid btn-play" width="70px"></a>
                                <p class="card-text fs-3"><span class="d-none d-lg-block">Click Play to learn
                                        more</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- Modal -->
    <div class="modal fade" id="headerVideo" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
            <div class="modal-content">
                <div class="modal-header border-0 text-center">
                    <button type="button"
                            class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12"
                            data-bs-dismiss="modal" aria-label="Close">X
                    </button>
                </div>
                <div class="modal-body firstTimeSetupChecklist px-3 mt-1">
                    <div class="first-time-user-popup-video">
                        <video width="100%" height="320" class="stopVideoOnModalHide rounded-3 object-cover"
                               controls>
                            <source src="{{isset($homes->hero_video_link) ? asset('storage/' . $homes->hero_video_link) : ''}}"
                                    type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--End Popover--}}
<!-- section  starts -->
    <section class="section-1 top-section mt-5 ">
        <div class="container  container-max-width">
            <div class="row h-100" data-aos="fade-right">
                <div class="col-12 col-md-6 mb-3 mb-lg-0 d-flex align-items-center text-center">
                    <div class="looping-img">
                        <img src="{{isset($homes->sec_one_step_first_image) ? asset('storage/' . $homes->sec_one_step_first_image) : asset('v1.1/images/looping.png')}}" class="img-fluid">
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3 mb-lg-0">
                    <div class="col-inner bg-image d-flex justify-content-center align-items-center" style="height: 620px">
                        <div class="p-3 text-center">
                            <h3>{{$homes->sec_one_step_first_title ?? 'Just send a link and....'}}</h3>
                            <img src="{{asset('v1.1/images/borders-group.png')}}" class="img-fluid">
                            <div class="my-1 my-md-3 fs-20 px-2 px-md-5 fs-mobile">{!! $homes->sec_one_step_first_desc ?? 'Ensure all clients are asked the same questions and given the same opportunities.' !!} </div>
                            <a href="{{route('register')}}" class="btn btn-primary-light-black-hover w-210 py-2 rounded-pill ">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section  starts -->
    <section class="section-1 mt-5">
        <div class="container  container-max-width">
            <div class="row h-100" data-aos="fade-right">

                <div class="col-12 col-md-6 mb-3 mb-lg-0">
                    <div class="col-inner bg-image d-flex justify-content-center align-items-center" style="height: 620px">
                        <div class="p-3 text-center">
                            <h3>{{$homes->sec_one_step_second_title ?? 'Just send a link and....'}}</h3>
                            <img src="{{asset('v1.1/images/borders-group.png')}}" class="img-fluid">
                            <div class="my-1 my-md-3 fs-20 px-2 px-md-5 fs-mobile">{!! $homes->sec_one_step_second_desc ?? 'Ensure all clients are asked the same questions and given the same opportunities.' !!} </div>
                            <a href="{{route('register')}}" class="btn btn-primary-light-black-hover w-210 py-2 rounded-pill ">Sign Up</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-lg-0 d-flex align-items-center text-center">
                    <div class="looping-img">
                        <img src="{{isset($homes->sec_one_step_second_image) ? asset('storage/' . $homes->sec_one_step_second_image) : asset('v1.1/images/looping.png')}}" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- section  starts -->

    <!-- section  starts -->
    <section class="section-1 mt-5">
        <div class="container  container-max-width">
            <div class="row h-100" data-aos="fade-right">
                <div class="col-12 col-md-6 mb-3 mb-lg-0 d-flex align-items-center text-center">
                    <div class="looping-img">
                        <img src="{{isset($homes->sec_one_step_third_image) ? asset('storage/' . $homes->sec_one_step_third_image) : asset('v1.1/images/looping.png')}}" class="img-fluid">
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3 mb-lg-0">
                    <div class="col-inner bg-image d-flex justify-content-center align-items-center" style="height: 620px">
                        <div class="p-3 text-center">
                            <h3>{{$homes->sec_one_step_third_title ?? 'Just send a link and....'}}</h3>
                            <img src="{{asset('v1.1/images/borders-group.png')}}" class="img-fluid">
                            <div class="my-1 my-md-3 fs-20 px-2 px-md-5 fs-mobile">{!! $homes->sec_one_step_third_desc ?? 'Ensure all clients are asked the same questions and given the same opportunities.' !!} </div>
                            <a href="{{route('register')}}" class="btn btn-primary-light-black-hover w-210 py-2 rounded-pill ">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section  starts -->
    <section class="section-1 mt-5">
        <div class="container  container-max-width">
            <div class="row h-100" data-aos="fade-right">

                <div class="col-12 col-md-6 mb-3 mb-lg-0">
                    <div class="col-inner bg-image d-flex justify-content-center align-items-center" style="height: 620px">
                        <div class="p-3 text-center">
                            <h3>{{$homes->sec_one_step_fourth_title ?? 'Just send a link and....'}}</h3>
                            <img src="{{asset('v1.1/images/borders-group.png')}}" class="img-fluid">
                            <div class="my-1 my-md-3 fs-20 px-2 px-md-5 fs-mobile">{!! $homes->sec_one_step_fourth_desc ?? 'Ensure all clients are asked the same questions and given the same opportunities.' !!} </div>
                            <a href="{{route('register')}}" class="btn btn-primary-light-black-hover w-210 py-2 rounded-pill ">Sign Up</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-lg-0 d-flex align-items-center text-center">
                    <div class="looping-img">
                        <img src="{{isset($homes->sec_one_step_fourth_image) ? asset('storage/' . $homes->sec_one_step_fourth_image) : asset('v1.1/images/looping.png')}}" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- section  starts -->
    <section class="section-1 mt-5">
        <div class="container  container-max-width">
            <div class="row h-100" data-aos="fade-right">
                <div class="col-12 col-md-6 mb-3 mb-lg-0 d-flex align-items-center text-center">
                    <div class="looping-img">
                        <img src="{{isset($homes->sec_one_step_fifth_image) ? asset('storage/' . $homes->sec_one_step_fifth_image) : asset('v1.1/images/looping.png')}}" class="img-fluid">
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3 mb-lg-0">
                    <div class="col-inner bg-image d-flex justify-content-center align-items-center" style="height: 620px">
                        <div class="p-3 text-center">
                            <h3>{{$homes->sec_one_step_fifth_title ?? 'Just send a link and....'}}</h3>
                            <img src="{{asset('v1.1/images/borders-group.png')}}" class="img-fluid">
                            <div class="my-1 my-md-3 fs-20 px-2 px-md-5 fs-mobile">{!! $homes->sec_one_step_fifth_desc ?? '<p>Ensure all clients are asked the same questions and given the same opportunities.</p>' !!} </div>
                            <a href="{{route('register')}}" class="btn btn-primary-light-black-hover w-210 py-2 rounded-pill ">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{--        How it works--}}

<!-- working section -->

    <section class="how-works-section">
        <div class="left-img">
            <div class="right-img">
                <div class="container">
                    <div class="row margin-y text-center" data-aos="fade-down">
                        <div>
                            <h1 class="fw-bolder text-center">{{$homes->how_it_works_title ?? 'How it Works'}} </h1>
                            <img src="{{asset('v1.1/images/border-group.png')}}" class="img-fluid">
                        </div>
                    </div>

                    <div class="row align-items-center flex-column-reverse flex-lg-row"  data-aos="fade-down">
                        <div class="col-lg-4 pt-4 pt-lg-0">
                            <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                                <div
                                    class="d-flex align-items-center rounded-circle rounded-background justify-content-center">
                                    <p class="fs-1 text-white rotated-text fw-lighter  m-0 pt-3">STEP</p>
                                    <p class="text-white step-no pe-3">1</p>
                                </div>
                                <p class="fs-1 fw-bolder ps-3">{{$homes->sec_two_step_first_title ?? 'Send a Link'}}</p>
                            </div>
                            <div class="step-text pt-5 fs-2 font-roboto text-center text-lg-start">
                                {!! $homes->sec_two_step_first_desc ?? ' Send your buyer your OfferForm link VIA text,
                                email or copy the link to your website.' !!}
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <img src="{{isset($homes->sec_two_step_first_image) ? asset('storage/' . $homes->sec_two_step_first_image) : asset('v1.1/images/mobile-images.png')}}" class="img-fluid">
                        </div>
                    </div>
                    <!-- second row starts -->
                    <div class="row  align-items-center  row-max-width-2 my-5 my-md-0 overflow-hidden" data-aos="fade-up">
                        <div class="col-lg-7 text-start">
                            <img src="{{isset($homes->sec_two_step_second_image) ? asset('storage/' . $homes->sec_two_step_second_image) : asset('v1.1/images/mobile-img-2.png')}}" class="img-fluid">
                        </div>
                        <div class="col-lg-5 pt-4 pt-lg-0">
                            <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                                <div
                                    class="d-flex align-items-center rounded-circle rounded-background justify-content-center">
                                    <p class="fs-1 text-white rotated-text fw-lighter  m-0 pt-3">STEP</p>
                                    <p class="text-white step-no pe-3">2</p>
                                </div>
                                <p class="fs-1 fw-bolder ps-3">{{$homes->sec_two_step_second_title ?? 'Send a Link'}}</p>
                            </div>
                            <div class="step-text pt-5 fs-2 font-roboto text-center text-lg-start">
                                {!! $homes->sec_two_step_second_desc ?? ' Send your buyer your OfferForm link VIA text,
                                email or copy the link to your website.' !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="how-works-section overflow-hidden">
        <div class="left-img-bottom">
            <div class="right-img-bottom">
                <div class="container">
                    <!-- third row -->
                    <div class="row  align-items-center row-max-width-1" data-aos="fade-in">
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                                <div
                                    class="d-flex align-items-center rounded-circle rounded-background justify-content-center">
                                    <p class="fs-1 text-white rotated-text fw-lighter  m-0 pt-3">STEP</p>
                                    <p class="text-white step-no pe-3">3</p>
                                </div>
                                <p class="fs-1 fw-bolder ps-3">{{$homes->sec_two_step_third_title ?? 'Send a Link'}}</p>
                            </div>
                            <div class="step-text pt-5 fs-2 font-roboto text-center text-lg-start">
                                {!! $homes->sec_two_step_third_desc ?? ' Send your buyer your OfferForm link VIA text,
                                 email or copy the link to your website.' !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{isset($homes->sec_two_step_third_image) ? asset('storage/' . $homes->sec_two_step_third_image) : asset('v1.1/images/mobile-1.png')}}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container  py-5">
            <div class="row text-center">
                <div>
                    <h2 class="fw-bolder font-manrope-medium">Agent Testimonials</h2>
                    <img src="{{asset('v1.1/images/border-group.png')}}" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- slider section -->
    <section class="slider-section py-5">
        <div class="container">
            <div class="row justify-content-center slider-max-width">
                <div class="col-10 col-md-7 mx-auto">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($testimonials as $t)
                                <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}} ">
                                    <div>
                                        <div class="card text-white bg-transparent border-0 text-center">
                                            <img src="{{isset($t->image) ? asset('storage/' . $t->image) : asset('v1.1/images/header-bg.png')}}" class="img-fluid">
                                            <div class="card-img-custom-overlay d-grid align-items-center h-100">
                                                <h5 class="card-title fs-2"><span class="d-none d-lg-block">OfferForm in 60 seconds</span></h5>
                                                <a href="javascript:void(0)"

                                                   @if(!$t->video == null)
                                                   data-bs-toggle="modal" data-bs-target="#testimonial{{$t->id}}Video"
                                                    @endif
                                                >
                                                    <img src="{{asset('v1.1/images/play-btn.svg')}}" class="img-fluid play-btn" width="60px">
                                                </a>
                                                <p class="card-text fs-3"><span class="d-none d-lg-block">Click Play to learn
                                                    more</span></p>
                                            </div>
                                        </div>
                                        <div class="text-center ">
                                            <p class="color-purple fs-4 mb-0 font-roboto">{{$t->name}}</p>
                                            <p class="text-secondary fs-5">{{$t->location}}</p>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="testimonial{{$t->id}}Video" data-bs-backdrop="static" data-bs-keyboard="false"
                                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                                        <div class="modal-content">
                                            <div class="modal-header border-0 text-center">
                                                <button type="button"
                                                        class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12"
                                                        data-bs-dismiss="modal" aria-label="Close">X
                                                </button>
                                            </div>
                                            <div class="modal-body firstTimeSetupChecklist px-3 mt-1">
                                                <div class="first-time-user-popup-video">
                                                    <video width="100%" height="320" class="stopVideoOnModalHide rounded-3 object-cover"
                                                           controls>
                                                        <source src="{{isset($t->video) ? asset('storage/' . $t->video) : ''}}"
                                                                type="video/mp4">
                                                    </video>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-3 py-md-5 mb-4">
        <div class="row text-center create-account">
            <div class="col-12">
                <a href="{{route('register')}}" class="btn btn-primary-light-black-hover py-3 px-5 rounded-pill">CREATE FREE ACCOUNT</a>
            </div>
        </div>
    </div>

    @push('scripts')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>

        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>

        <script>
            $(".btnStopVideoOnModalHide").click(function () {
                $('.stopVideoOnModalHide').trigger('pause');
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

        <script>
            $(document).ready(function (){

                var typed2 = new Typed('#sliderText', {
                    strings: [' ','Fair and Equal Treatment','Full Transparency','Increased Buyer involvement','Video education'],
                    typeSpeed: 120,
                    backSpeed: 60,
                    fadeOut: false,
                    cursorChar: ' ',
                    loop: true,
                    smartBackspace: false,
                });

            });
        </script>

    @endpush
</x-guest-layout>
