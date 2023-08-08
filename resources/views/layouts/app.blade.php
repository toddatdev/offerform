<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.favicon')
    <title>{{ config('app.name', 'Index') }}</title>

    <!-- font-awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Animate-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


    <link rel="stylesheet" href="https://nuintun.github.io/mailtip/stylesheets/mailtip.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5-theme.min.css" />

    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @stack('stylesheets')
    <x-smartlook />

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
    </style>

</head>
<body style="background-color: #f7f7fd !important;overflow-x: hidden !important;">
@if(!is_null(Cookie::get('login_back')))
    <livewire:login-back-to-admin />
@endif
<div class="min-h-screen bg-gray-100">

@include('layouts.navigation')
    <!-- Page Content -->
    <main class="py-4">
        {{ $slot }}
    </main>
    @include('partials.notifications')
    @include('layouts.footer')
</div>

@role('agent')
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js-na1.hs-scripts.com/21258858.js"></script>
<!-- End of HubSpot Embed Code -->
@endrole

<!-- Scripts -->
@livewireScripts
<script>
    var CKEDITOR_BASEPATH = '/vendor/ckeditor/';
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@stack('scripts')
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

        window.livewire.on('copy-to-clipboard', (text) => {
            navigator.clipboard.writeText(text).then(function() {
                /* clipboard successfully set */
            }, function() {
                copy(text);
            })

        });
    });
</script>
<script>
    var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'))
    var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
        return new bootstrap.Offcanvas(offcanvasEl)
    })
</script>

<script src="https://nuintun.github.io/mailtip/javascripts/jquery.mailtip.js"></script>

<script>

    $(function (){
        $('.autocomplete-email').mailtip({

            mails: ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com','aol.com', 'icloud.com']

        });
    });
</script>

<script>

    $(function (){
        $('.autocomplete-transaction-email').mailtip({

            mails: ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com','aol.com', 'icloud.com']

        });
    });

</script>
<script>
    // Expand Input field

    const $autoExpandTextareas = document.querySelectorAll("textarea.auto-expand");

    function addMultiEventListeners(el, s, fn) {
        s.split(" ").forEach(e => el.addEventListener(e, fn, false));
    }

    $autoExpandTextareas.forEach(function(el) {
        addMultiEventListeners(el, "change keydown paste", function() {
            autoExpand(el);
        });
    });

    function autoExpand(el) {
        setTimeout(function() {
            el.style.cssText = "height: auto";
            el.style.cssText = `height: ${7 + el.scrollHeight}px`;
        }, 0);
    }

    window.onresize = function() {
        $autoExpandTextareas.forEach(function(el) {
            autoExpand(el);
        });
    };
</script>

</body>
</html>
