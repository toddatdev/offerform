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

    <link rel="stylesheet" href="https://nuintun.github.io/mailtip/stylesheets/mailtip.css">

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>--}}

{{--    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />--}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.0/dist/aos.css" />

    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('stylesheets')

{{--    <style>--}}
{{--        .container{--}}
{{--            overflow: hidden;--}}
{{--        }--}}
{{--    </style>--}}
    <x-smartlook />
</head>
<body
    style="background-image: url('{{ asset("img/guest/bg-header-" . (request()->routeIs('guest.index') ? 'lg' : 'sm'). ".png") }}'); background-repeat: no-repeat; width: 100%; background-position: top;
        background-size: 100%;">
@include('layouts.navigation')

@isset($title)
    <h1 class="text-center my-5">{{ $title }}</h1>
@endisset

<main>
    {{ $slot }}
</main>
@include('layouts.footer')
<!-- Scripts -->
@livewireScripts
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
<!-- Calendly inline widget end -->
@stack('scripts')

<script>
    $(document).ready(function () {

    });
</script>



<script>
    $(document).ready(function () {
        $("#pricingScroll").click(function (e) {
            $('html, body').animate({
                scrollTop: $("#pricingSection").offset().top
            }, 1000);
        });
    });
</script>

{{--<script src="https://unpkg.com/aos@next/dist/aos.js"></script>--}}
<script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1500,
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
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>
</body>


</html>
