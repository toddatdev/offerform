<x-guest-layout>

    @push('stylesheets')
        <style>

            .jcalendar-table table tbody td {
                /*padding: 32px 5px !important;*/
            }

            .jcalendar-selected {
                background: #9c4edd70;
                border-radius: 50%;
                width: 45px;
                height: 45px;
                color: #9c4edd;
                font-weight: bold !important;
            }

            /* .jcalendar-table table thead tr {
                display: flex;
                justify-content: center;
            }

            .jcalendar-table table thead .jcalendar-prev {
                order: 1;
            }

            .jcalendar-table table thead .jcalendar-next {
                order: 1;
            } */

            .jcalendar-header {
                color: #9c4edd;
            }

            .jcalendar-table table tbody td {
                padding: 11px 9px;
            }

            .calendar {
                width: 90%;
                margin: 0 auto;
                position: relative;
            }

            .calendar .jcalendar-header {
                color: #9c4edd;
                text-align: center;
                position: absolute;
                left: 0;
                right: 0;
            }

            .calendar .jcalendar-table > table > thead {
                cursor: pointer;
                margin: 0 0 50px;
                display: inline-block;
            }

            td.jcalendar-prev {
                position: absolute;
                left: 30px;
                top: 0;
                background: url(images/prev.png) no-repeat !important;
                width: 30px;
                height: 30px;
                z-index: 9;
            }

            td.jcalendar-prev:hover {
                background: url('images/prev_hover.png') no-repeat !important;
            }

            td.jcalendar-next {
                position: absolute;
                right: 30px;
                top: 0;
                background: url('images/next.png') no-repeat !important;
                width: 30px;
                height: 30px;
                z-index: 9;
            }

            td.jcalendar-next:hover {
                background: url('images/next_hover.png') no-repeat !important;
            }

            /* .calendar .jcalendar-prev {
                position: absolute;
                right: 70px;
            }
            .calendar .jcalendar-next {
                position: absolute;
                right: 30px;
            } */

            .cal_main_cont #calendar .jcalendar-prev {
                position: absolute;
                right: 70px;
            }

            .cal_main_cont #calendar .jcalendar-next {
                position: absolute;
                right: 30px;
            }

            .cal_main_cont #calendar {
                position: relative;
            }

            .cal_main_cont #calendar .jcalendar-table thead td {
                text-align: left;
            }

            .cal_main_cont-time {
                margin: 50px 0 0;
            }

            .cal_main_cont #calendar .jcalendar-table > table > tbody td {
                box-sizing: border-box;
                cursor: pointer;
                font-size: 0.9em;
                font-weight: bold;
            }

            .cal_main_cont #calendar .jcalendar-header {
                position: absolute;
                left: 0;
                top: 0;
            }

            .cal_main_cont #calendar .jcalendar-table > table > thead tr {
                margin: 0 0 40px;
                display: block;
                width: 100%;
            }


            .time_list ul li::before {
                display: none;
            }

            .time_list ul li {
                display: block;
                padding: 0;
                margin-bottom: 15px;
            }

            .time_list ul li:last-child {
                margin-bottom: 0;
            }

            .time_list .form_input_radio span {
                font-size: 16px;
                font-weight: 700;
                display: block;
                padding: 13px 11px;
                text-align: center;
                border: 1px solid #c4c4c4;
                width: 100%;
                border-radius: 5px;
            }

            .time_list .form_input_radio span::after,
            .time_list .form_input_radio span::before {
                display: none;
            }

            .time_list .form_input_radio {
                width: 100%;
                padding: 0;
            }

            .time_list .form_input_radio input[type="radio"]:checked + span {
                border-color: #4b0049;
                color: #4b0049;
            }

            .form_input_radio input[type="radio"] {
                visibility: hidden;
                display: none;
            }

            .top_time ul {
                display: flex;
                flex-wrap: wrap;
                margin: 0 -10px 20px;
                align-items: center;
            }

            .top_time ul li span {
                padding: 10px 24px;
                font-size: 15px;
                font-weight: bold;
                border-radius: 5px;
                border: 1px solid #9c4edd;
                display: block;
                text-align: center;
            }

            .top_time ul li .btn_nxt_pr {
                padding: 14px 24px;
                font-size: 15px;
                border-radius: 5px;
                background: #9c4edd;
                display: block;
                text-align: center;
                min-width: 120px;
                font-weight: bold;
                text-transform: capitalize;
            }


            @media (max-width: 576px) {
                .w-180 {
                    width: 140px;
                    padding: 5px 4px;
                    font-size: 13px;
                }
            }

            @media (max-width: 375px) {
                .w-180 {
                    width: 120px;
                    padding: 5px 1px;
                    font-size: 11px;
                }
            }

        </style>
    @endpush


        <div class="container demo my-5">
            {{--        <div class="col mx-5 my-5" data-aos="fade-up">--}}
            {{--            <video controls="" class="w-100">--}}
            {{--                <source src="https://offer-form.dedicateddevelopers.us/storage/demo_page/videos/1634731726-6599.mp4"--}}
            {{--                        type="video/mp4">--}}
            {{--            </video>--}}
            {{--        </div>--}}

            <livewire:demo />
        </div>

        {{--    Pick a Slot--}}

        <div class="container pick-a-slot my-3 pb-5">
            <h1 class="text-center h1 ">Pick a <b>Slot</b></h1>
            <p class="text-center h4 fw-normal">Pick a time for a 1 on 1 live demo with us</p>

            <div class="d-block d-lg-flex justify-content-center">
                <div class="min-width-440" data-aos="fade-left " style="">
                    <div class="card shadow p-4" style="margin-top: 68px;margin-bottom: 40px;border-radius: 6px">
                        <div class="card-body">
                            <img class="img-fluid rounded-circle" src="{{asset('img/demo/mark-lumpkin.jpg')}}" style="width: 65px;height: 65px;object-fit: cover" alt="">
                            <h4 class="fw-bold my-3 light-dark" >Mark Lumpkin</h4>
                            <h4 class="fw-bold">One-on-One</h4>
                            <div class="my-4">
                                <div class="my-3"><img class="img-fluid" src="{{asset('img/demo/icons/clock.svg')}}" alt=""><span
                                        class="mx-2 fw-bold"> 30 mins</span></div>
                                <div class="my-3"><img class="img-fluid" src="{{asset('img/demo/icons/phone.svg')}}" alt=""><span
                                        class="mx-2 fw-bold"> (541) 606-7200</span></div>
                                <div class="my-3"><img class="img-fluid" src="{{asset('img/demo/icons/email.svg')}}" alt=""><span
                                        class="mx-2 fw-bold"> Mark@offerform.com</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="min-width-730" data-aos="fade-right " style="">
                    <div class="calendly-inline-widget"
                         data-url="https://calendly.com/mark-2124/30min?hide_event_type_details=1&hide_gdpr_banner=1&primary_color=7b2dbf"
                         style="min-width:320px;height:730px;">
                    </div>
                </div>
            </div>

            {{--        <div class="row my-5">--}}
            {{--            <div class="col-12 col-lg-4 pe-lg-0" data-aos="fade-left">--}}
            {{--                <div class="card shadow p-4" style="margin-top: 68px;margin-bottom: 40px">--}}
            {{--                    <div class="card-body">--}}
            {{--                        <img class="img-fluid rounded-circle" src="{{asset('img/demo/demo-img-1.png')}}" alt="">--}}
            {{--                        <h4 class="fw-bold my-3 light-dark" >Mark Lumpkin</h4>--}}
            {{--                        <h4 class="fw-bold">One-on-One</h4>--}}
            {{--                        <div class="my-4">--}}
            {{--                            <div class="my-3"><img class="img-fluid" src="{{asset('img/demo/icons/clock.svg')}}" alt=""><span--}}
            {{--                                    class="mx-2 fw-bold"> 30 mins</span></div>--}}
            {{--                            <div class="my-3"><img class="img-fluid" src="{{asset('img/demo/icons/phone.svg')}}" alt=""><span--}}
            {{--                                    class="mx-2 fw-bold"> (541) 606-7200</span></div>--}}
            {{--                            <div class="my-3"><img class="img-fluid" src="{{asset('img/demo/icons/email.svg')}}" alt=""><span--}}
            {{--                                    class="mx-2 fw-bold"> Mark@offerform.com</span></div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            {{--            <div class="col-12 col-lg-8 ps-lg-0" data-aos="fade-right">--}}
            {{--                <!-- Calendly inline widget begin -->--}}
            {{--                <div class="calendly-inline-widget"--}}
            {{--                     data-url="https://calendly.com/ddnouman-1/30min?hide_event_type_details=1&hide_gdpr_banner=1&primary_color=7b2dbf"--}}
            {{--                     style="min-width:320px;height:730px;">--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
        </div>


        @push('scripts')

            <script>
                $(document).ready(function () {
                    Calendly.initInlineWidget({
                        // url: 'https://calendly.com/tayyab-devdi/30min?hide_gdpr_banner=1&hide_landing_page_details=1&hide_event_type_details=1',
                        parentElement: document.getElementById('calendly'),
                        prefill: {},
                        utm: {}
                    });
                })

            </script>

            <!-- custom js part -->
            <script src="https://jsuites.net/v4/jsuites.js"></script>

            <script>

                jSuites.calendar(document.getElementById('calendar'), {
                    format: 'YYYY-MM-DD',
                    onupdate: function (a, b) {
                        const date = new Date(b);
                        console.log('data', date.toLocaleDateString());
                        document.getElementById('selected_date').innerHTML = date.toDateString();
                        $("#slot_date").val(date.toLocaleDateString());
                    }
                });

                $('input[type=radio][name=slot_time]').change(function () {
                    const time = this.value;
                    document.getElementById('selected_time').innerHTML = time;

                });
            </script>

            <script>
                $(document).ready(function () {
                    window.livewire.on('showToast', (name, message, error = 0) => {
                        jSuites.notification({
                            error,
                            name,
                            message,
                        })
                    });
                });
            </script>

        @endpush

</x-guest-layout>
