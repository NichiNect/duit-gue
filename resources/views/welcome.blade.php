<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <x-navbar></x-navbar>
        
        <div class="container mt-5">
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-4">{{ config('app.name', 'DuitGue') }}</h1>
                    <hr>
                    <p class="lead">This app is a personal bookkeeping web application, built with <a href="https://laravel.com">Laravel Framework</a>. It designed for easy bookkeeping for personal income and spending. </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>