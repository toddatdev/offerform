<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.favicon')
    <title>{{ config('app.name', 'Index') }}</title>

    <!-- font-awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="https://nuintun.github.io/mailtip/stylesheets/mailtip.css">

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Quintessential&display=swap');
        .btn-signature{
            font-family: 'Quintessential', cursive;
        }

        .quintessential-font{

            font-family: 'Quintessential', 'cursive';
        }
        .letter-space1{
            letter-spacing: 1px !important;
        }


        .recordVideoModule div:first-child {
            width: 300px !important;
            height: 250px !important;
            margin: auto;
            padding: 10px 0 !important;
        }

        .recordImageModule div:first-child {
            width: 300px !important;
            height: 250px !important;
            margin: auto;
        }

        .recordImageModule canvas {
            width: 300px !important;
            height: 250px !important;
            margin: auto;
        }

        .vjs-mouse-display{
            display: none !important;
        }

       .vjs-volume-bar.vjs-slider-bar.vjs-slider.vjs-slider-horizontal {
           display: none !important;
       }


    </style>

    @stack('stylesheets')
    <style>


        .sign-tabs .nav-tabs .nav-link, .nav-tabs .nav-item.show .nav-link {
            color: #ffffff;
            background-color: #9C4EDD;
            border: none;
            border-color: #212529 #dee2e6 white;
        }

        .sign-tabs .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
            color: #ffffff;
            background-color: #212529;
            border: none;
            border-color: #212529 #dee2e6 white;
        }

        .underline-text{
            text-decoration: underline !important;
        }
        .anychart-credits {
            display: none;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        /*@media (max-width: 576px) {*/
        /*    tspan {*/
        /*        font-size: 7px;*/
        /*        font-weight: 600;*/
        /*    }*/
        /*}*/

        .jcalendar-header {
            color: #9c4edd;
        }

        video {
            width: 100% !important;
        }

        .jcalendar-header span {
            font-size: 20px !important;
        }

        .jcalendar-selected {
            background: transparent;
            background-repeat: no-repeat;
            background-position: center;

            color: #9c4edd;
            font-weight: bold !important;
            background-image: url("data:image/svg+xml,%3Csvg width='35' height='35' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 20C40 31.0457 31.0457 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20Z' fill='%23E6D2F6'/%3E%3C/svg%3E");
        }

        .jcalendar-selected:hover {
            background: transparent;
            background-repeat: no-repeat;
            background-position: center;

            color: #9c4edd;
            font-weight: bold !important;
            background-image: url("data:image/svg+xml,%3Csvg width='35' height='35' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 20C40 31.0457 31.0457 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20Z' fill='%23E6D2F6'/%3E%3C/svg%3E");
        }

        .calendar {
            width: 75%;
            margin: 0 auto;
            position: relative;
        }

        .jcalendar-weekday {
            background-color: #cccccc00;
            font-weight: bold;
        }

        .jcalendar-set-day:hover {
            background: transparent;
            background-repeat: no-repeat;
            background-position: center;

            color: #9c4edd;
            font-weight: bold !important;
            background-image: url("data:image/svg+xml,%3Csvg width='35' height='35' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 20C40 31.0457 31.0457 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20Z' fill='%23E6D2F6'/%3E%3C/svg%3E");
        }

        .jcalendar-prev {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' %3E%3Cpath fill='%23CCCCCC' d='M15.41 16.59 10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z'/%3E%3Cpath fill='none' d='M0 0h24v24H0V0z'/%3E%3C/svg%3E");
            background-position: 0;
            background-size: 40px 40px;
        }

        .jcalendar-prev:hover {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' %3E%3Cpath fill='%239c4edd' d='M15.41 16.59 10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z'/%3E%3Cpath fill='none' d='M0 0h24v24H0V0z'/%3E%3C/svg%3E");
        }

        .jcalendar-next {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' %3E%3Cpath fill='%23CCCCCC' d='M8.59 16.59 13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z'/%3E%3Cpath fill='none' d='M0 0h24v24H0V0z'/%3E%3C/svg%3E");
            background-position: 100%;
            background-size: 40px 40px;

        }

        .jcalendar-next:hover {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' %3E%3Cpath fill='%239c4edd' d='M8.59 16.59 13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z'/%3E%3Cpath fill='none' d='M0 0h24v24H0V0z'/%3E%3C/svg%3E");
        }

        video {
            width: 100% !important;
        }

        .pie-chart-container {

        }

        .pie-chart {

        }

        @media only screen and (min-width: 768px) {
            .pie-chart-container {

            }

            .pie-chart {
                margin-left: -29px !important;
            }
        }

        @media only screen and (max-width: 767px) {
            .pie-chart-container {
                width: 275px !important;
            }

            .pie-chart {
                width: 365px !important;
                margin-left: -29px !important;
            }
        }
    </style>

    <style>

        .form-group {
            position: relative;
        }

        .animated-label {
            position: absolute;
            top: 40px;
            left: 0;
            bottom: 0;
            z-index: 2;
            width: 100%;
            font-weight: 300;
            opacity: 0.5;
            cursor: text;
            transition: 0.2s ease all;
            margin: 0;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .animated-label:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 45%;
            height: 2px;
            width: 10px;
            visibility: hidden;
            background-color: #8e44ad;
            transition: 0.2s ease all;
        }

        .form-control:focus {
            border-bottom-color: rgba(0, 0, 0, 0.12);
        }

        .form-control:focus ~ .animated-label {
            top: 0;
            opacity: 1;
            color: #8e44ad;
            font-size: 12px;
        }

        .form-control:focus ~ .animated-label:after {
            visibility: visible;
            width: 100%;
            left: 0;
        }


    </style>
    <style>

        ul.ui-mailtip {
            min-width: 100% !important;
            border-radius: 5px;
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%) !important;
        }

        ul.ui-mailtip li {
            color: #000000;
            background: #ffffff;
            font-size: 15px;
            font-family: 'Circular-Loom';
            font-style: normal;
        }

        ul.ui-mailtip li.active {
            font-weight: 500;
            color: #ffffff;
            background-color: #9C4EDD;
        }
    </style>
    <style>
        html {
            scroll-behavior: smooth !important;
        }
    </style>
    <x-smartlook/>
</head>

{{--    @if(!request()->routeIs('dash.offer-forms.step.edit'))--}}

{{--        background: url('{{ asset("img/offer-form-step/bg-header.png") }}') top center no-repeat,--}}
{{--        url('{{ asset("img/offer-form-step/houses-images.png") }}') bottom center fixed ;--}}

{{--    @else--}}
{{--        background: url('{{ asset("img/offer-form-step/bg-header.png") }}') top center no-repeat;--}}
{{--    @endif--}}

<body style="  width: 100%; background-size: 100%;"
      class="pt-5 offer-form-body

    @if(!request()->routeIs('dash.offer-forms.step.edit')) body-preview-screen @else body-bg-image  @endif

          ">

<div class="container-fluid px-2 px-lg-5 agentInfoModal">
    <div class="d-flex justify-content-between user-profile-questionnaire">
        <x-application-logo class="user-profile-questionnaire-img" style="height: 45px"/>
        <div class="d-flex ">
            <div class="flex-shrink-0 align-self-center">
                @if(isset($agent->profile_photo_url))
                    <img class="rounded-circle dp" style="width: 55px; height: 55px ; object-fit: cover"
                         src="{{ $agent->profile_photo_url}}" alt="...">
                @else
                    <span
                        class="text-uppercase rounded-circle d-flex justify-content-center align-items-center bg-primary-lighter text-white text-center fw-500 fs-20 me-2"
                        style="height: 45px; width: 45px">
                        {{Str::limit($agent->first_name, 1, '')}}{{Str::limit($agent->last_name, 1, '')}}
                    </span>
                @endif
            </div>
            <div class="flex-grow-1 ms-1 ms-lg-3">
                <ul class="fa-ul flex flex-column justify-content-evenly">

                    @if(!is_null($agent->full_name))
                        <li class=""><span class="fa-li">
                                <img class="w-17 me-2" src="{{ asset('img/menu-icons/broker.svg') }}" alt=""></span>

                            <a href="#" class="text-decoration-none fw-bold">
                                {{ $agent->full_name}}
                            </a>
                        </li>
                    @endif

                    @if(!is_null($agent->phone))
                        <li class="d-none d-lg-block"><span class="fa-li">
                                <img class="w-17 me-2" src="{{asset('img/menu-icons/mobile.svg')}}" alt=""></span>
                            <a href="tel:{{ $agent->phone }}" class="text-decoration-none fw-bold text-dark">
                                {{ $agent->phone }}
                            </a>
                        </li>
                    @endif

                    @if(!is_null($agent->email))
                        <li class="d-none d-lg-block"><span class="fa-li">
                                <img class="w-17 me-2" src="{{asset('img/menu-icons/mail.svg')}}" alt=""></span>
                            <a href="mailto:{{ $agent->email }}" class="text-decoration-none fw-bold text-dark">
                                {{ $agent->email ?? '' }}
                            </a>
                        </li>
                    @endif

                    <li class="" style="line-height: 15px"><span class="fa-li">
                            <img class="w-14 me-2" src="{{asset('img/menu-icons/hand-icon.svg')}}" alt=""></span>
                        <a href="#" class="text-decoration-none click-for-more-info-btn fw-bold" data-bs-toggle="modal"
                           data-bs-target="#clickForMoreInfo">
                            Click For Contact Info
                        </a>
                    </li>

                    <div class="modal fade" id="clickForMoreInfo" aria-hidden="true"
                         aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered agentModal max-width-980">
                            <div class="modal-content rounded-30">

                                <div class="modal-header border-0 ms-auto pb-0">
                                    <a href="javascript:void(0)"
                                       class="text-decoration-none"
                                       data-bs-dismiss="modal" aria-label="Close">
                                        {{--                                       <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">--}}
                                        <img src="{{asset('img/menu-icons/cross-icon.svg')}}"
                                             class="w-30 svg-hover-black" alt="">
                                    </a>
                                </div>

                                <div class="modal-body text-center px-2 px-lg-4 py-2 py-lg-4">
                                    @include('partials.agent-intro-modal', ['class' => 'w-full-md-65', 'eid' => 'summary' . time()])
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
<main class="container" style="padding-bottom: 60px !important;">
    {{ $slot }}
</main>
@stack('modals')
<div class="modal fade" id="previewVideoInEditMode" aria-hidden="true"
     aria-labelledby="previewVideoInEditModeModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-body p-0">
                <button type="button"
                        class="position-absolute top-0 end-0 mt-3 me-3 border-0 rounded-circle bg-primary-light text-white"
                        style="width: 30px; height: 30px"
                        data-bs-dismiss="modal" aria-label="Close">X
                </button>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item w-100" autoplay="false"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            style="height: 350px"
                            src=""></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@includeWhen(request()->routeIs('dash.offer-forms.step.edit'), 'layouts.footer')

<!-- Scripts -->
@livewireScripts
<script>
    var CKEDITOR_BASEPATH = '/vendor/ckeditor/';
</script>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
<script>
    $(function () {
        $('#previewVideoInEditMode').on('show.bs.modal', function (event) {
            let target = $(event.relatedTarget);
            $(this).find('iframe').attr('src', $('#' + target.attr('id')).attr('data-video-link'))
        })
    });
    $('#previewVideoInEditMode').on('hidden.bs.modal', function () {
        $(this).find('iframe').attr('src', '');
    })
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
<script>
    $(document).ready(function () {
        window.livewire.on('hideModal', (reload = false) => {
            $('.hideableModal').each(function () {
                $(this).modal('hide');
            });
            if (reload) {
                window.location.reload();
            } else {
                $('.modal-backdrop').remove();
                $('body').css('overflow', '');
                $('body').css('padding-right', '');
                $('body').removeClass('modal-open');
            }
        });

        window.livewire.on('refresh-ckeditor', (id, data = '') => {
            const ckeditor = CKEDITOR.instances[id];
            ckeditor && ckeditor.setData(data);
        });

        window.livewire.on('remove-el', (id) => {
            const el = $(`#${id}`);

            if (el) {
                el.remove();
            }
        });

        window.livewire.on('copy-to-clipboard', (text) => {
            setTimeout(async () => await navigator.clipboard.writeText(text))
            copy(text);
        });

    });
</script>


<script>


    $(document).on('click', '.required-section-field', function (e) {

        var requiredSectionFieldID = $(this).data('id');

        $('#requiredEditStepSectionModal').modal('hide');

        $('html, body').animate({

            scrollTop: $(".requiredFieldMessage" + requiredSectionFieldID).offset().top

        }, 1000);
    });
</script>


<script>

    $(document).on('click', '.requiredFieldMessage', function (e) {

        console.log($(this).data('id'));

        var requiredFieldID = $(this).data('id');

        console.log(requiredFieldID);

        $('#requiredFieldsNotFilledModal').modal('hide');

        $('html, body').animate({

            scrollTop: $("." + requiredFieldID).offset().top

        }, 1000);

    });

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>


<script>


</script>

{{--Scroll Bottom on click--}}

<script>

    $(document).on('click', '.scrollBottomSectionButton', function (e) {

        var scrollBottomSectionID = $(this).data('id') + 1;

        $('html, body').animate({

            scrollTop: $(".scrollBottomCardSection" + scrollBottomSectionID).offset().top

        }, 1000);

    });

    $(window).scroll(function () {

        var windowsHeight = $(document).height() - $(window).height();

        var currentScroll = $(window).scrollTop()


        $(".attachToolBar").css({'top': currentScroll + 'px', 'transition': '280ms cubic-bezier(0.4,0,0.2,1)'});

        //if I scroll more than 80%

        if (((currentScroll * 100) / windowsHeight) > 90) {

            // $(".attachToolBar").css({'top': '0px', 'bottom':  '60px','transition': '280ms cubic-bezier(0.4,0,0.2,1)' });

        }

    });

    $(document).on('click', '.attachToolBarSection', function () {

        var sectionID = $(this).data('id');

        var sectionID = $(this).offset().top;

        $(".attachToolBar").css({'top': (sectionID - 255) + 'px'});


    });

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $('.stay-open').on('click', function (e) {

        var target = $(e.target);

        var dropdown = target.closest('.dropdown');

        return !dropdown.hasClass('open') || !target.hasClass('keep-open');
    });

</script>


<script src="https://nuintun.github.io/mailtip/javascripts/jquery.mailtip.js"></script>

<script>

    $(function () {
        $('.autocomplete-email').mailtip({

            mails: ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'aol.com', 'icloud.com']

        });
    });

    // $('.btn').click(function () {
    //     $('.msg').text($('.email').val());
    // })

</script>

<script>
    // Expand Input field

    const $autoExpandTextareas = document.querySelectorAll("textarea.auto-expand");

    function addMultiEventListeners(el, s, fn) {
        s.split(" ").forEach(e => el.addEventListener(e, fn, false));
    }

    $autoExpandTextareas.forEach(function (el) {
        addMultiEventListeners(el, "change keydown paste", function () {
            autoExpand(el);
        });
    });

    function autoExpand(el) {
        setTimeout(function () {
            el.style.cssText = "height: auto";
            el.style.cssText = `height: ${7 + el.scrollHeight}px`;
        }, 0);
    }

    window.onresize = function () {
        $autoExpandTextareas.forEach(function (el) {
            autoExpand(el);
        });
    };
</script>

{{--<script>--}}

{{--    var editor = CKEDITOR.replace();--}}

{{--    editor.on("mode", function(ev) {--}}
{{--        $(ev.editor.container.$).find("textarea.cke_source").attr({ title: "", "aria-label": "" });--}}
{{--    });--}}

{{--</script>--}}




{{--<script>--}}
{{--    $('a.playVideo').click(function (e) {--}}
{{--        e.preventDefault();--}}
{{--    });--}}
{{--</script>--}}

{{--<script>--}}
{{--    CKEDITOR.on("instanceReady", function(event) {--}}
{{--        event.editor.on("beforeCommandExec", function(event) {--}}
{{--            // Show the paste dialog for the paste buttons and right-click paste--}}
{{--            if (event.data.name == "paste") {--}}
{{--                event.editor._.forcePasteDialog = true;--}}
{{--            }--}}
{{--            // Don't show the paste dialog for Ctrl+Shift+V--}}
{{--            if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {--}}
{{--                event.cancel();--}}
{{--            }--}}
{{--        })--}}
{{--    });--}}
{{--</script>--}}
<script>
    $(document).ready(function () {
        window.livewire.on('location-reload', () => {
            window.location.reload();
        });
    });
</script>


{{--<script>--}}

{{--    $(function () {--}}
{{--        var h = $(window).height();--}}
{{--        document.addEventListener('drag', function (e) {--}}
{{--            var mousePosition = e.pageY - $(window).scrollTop();--}}
{{--            var topRegion = 220;--}}
{{--            var bottomRegion = h - 220;--}}
{{--            if (e.which === 1 && (mousePosition < topRegion || mousePosition > bottomRegion)) {--}}
{{--                var distance = e.clientY - h / 2;--}}
{{--                distance = distance * 0.1;--}}
{{--                $(document).scrollTop(distance + $(document).scrollTop());--}}
{{--            } else {--}}
{{--                $(document).unbind('mousemove');--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}

{{--</script>--}}


<script>
    $(".btnStopVideoOnModalHide").click(function(){
        $('.stopVideoOnModalHide').trigger('pause');
    });
</script>

{{--Video Module js--}}
<script>
    $(document).ready(function (){
        $('.open-video-module').on('click', function (){
            $('.video-module').trigger('click');

        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.video-module').change(function(e){
            var fileName = e.target.files[0].name;
            $('.file-name').html(fileName);
        });
    });
</script>


{{--<script>--}}
{{--    $(document).ready(function (){--}}

{{--        $('.open-cover-photo-module').on('click', function (){--}}
{{--            $('.uploadCoverPhotoModule').trigger('click');--}}

{{--        });--}}
{{--    });--}}
{{--</script>--}}

{{--<script>--}}
{{--    $(document).ready(function(){--}}
{{--        $('.upload-cover-module').change(function(e){--}}
{{--            var fileName = e.target.files[0].name;--}}
{{--            $('.file-name-cover-photo').html(fileName);--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

<script>
    var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
    triggerTabList.forEach(function (triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl)

        triggerEl.addEventListener('click', function (event) {
            event.preventDefault()
            tabTrigger.show()
        })
    })
</script>


</body>
</html>

