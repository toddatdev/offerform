<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
    @include('partials.favicon')
    <title>{{ config('app.name', 'OfferForm') }}</title>

    <link rel="stylesheet" href="{{ public_path('css/app.css')}}" />
    <style>
        @media print {
            * {
                page-break-inside: avoid;
                page-break-after: avoid;
                page-break-before: avoid;
            }
        }
    </style>
</head>
<body>
    <main class="py-4">
        {{ $slot }}
    </main>
</body>
</html>
