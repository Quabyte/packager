<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '2017 Turkish Airlines Euroleague') | Detur Official Travel Agency</title>

    <link rel="stylesheet" href="{{ asset('css/global/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    @yield('css')

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('fonts')
</head>
<body class="app">
    @include('partials.navbar')

    @yield('content')

    <script src="{{ asset('js/global/jquery.min.js') }}"></script>
    <script src="{{ asset('js/global/bootstrap.min.js') }}"></script>

    @yield('footer.js')
</body>
</html>