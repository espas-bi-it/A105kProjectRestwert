<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/bootstrap-4.0.0-dist/css/bootstrap.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Restwert Zürich</title>
</head>

<body>

    @unless (request()->is('/') || request()->is('customers/*'))
        @include('layouts.navigation')
        @include('nav-bar')
    @endunless
    @yield('content')

    <div class="container fixed-static">
        @yield('pagination')
    </div>
</body>

</html>