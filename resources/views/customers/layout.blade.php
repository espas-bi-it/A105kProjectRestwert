<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/bootstrap-4.0.0-dist/css/bootstrap.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        @unless (request()->is('customers/create'))
            @include('nav-bar')
        @endunless
        @yield('content')
        <script src="/bootstrap-4.0.0-dist/js/bootstrap.js">
        </script>
    </div>
</body>

</html>