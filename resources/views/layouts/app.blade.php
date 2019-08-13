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
</head>
<body class="bg-gray-200 h-screen antialiased leading-loose">
    <div id="app">
        <nav class="bg-blue-900 shadow mb-4 py-6 leading-none md:mb-8">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-center">
                    <div class="ml-6">
                        <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <div class="flex-1 text-right">
                        @guest
                            <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <span class="text-gray-300 text-sm pr-4">{{ Auth::user()->name }}</span>

                            <a href="{{ route('logout') }}"
                               class="no-underline hover:underline text-gray-300 text-sm p-3"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        @if(session('flash'))
            @php
                if (session('flash.type') === 'success') {
                    $classes = 'bg-green-200 text-green-900 border-green-700';
                } else if (session('flash.type') === 'danger') {
                    $classes = 'bg-red-200 text-red-900 border-red-700';
                } else if (session('flash.type') === 'warning') {
                    $classes = 'bg-yellow-300 text-yellow-900 border-yellow-500';
                } else {
                    $classes = 'bg-blue-200 text-blue-900 border-blue-700';
                }
            @endphp
            <div class="font-semibold w-full max-w-xl rounded-b border-t-8 mb-8 mx-auto py-3 px-4 {{ $classes }}">
                {{ session('flash.message') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
