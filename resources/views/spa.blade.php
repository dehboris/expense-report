<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @routes
    </head>
    <body class="bg-gray-100 text-gray-800 h-screen antialiased leading-loose">
        @include('nav')
        <div id="app"></div>

        <script src="{{ asset('js/app.js') }}" type="text/javascript" defer></script>
    </body>
</html>
