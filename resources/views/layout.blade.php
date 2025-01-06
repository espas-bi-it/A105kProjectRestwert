<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/bootstrap-4.0.0-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <!-- Scripts -->
    <title>Restwert Zürich</title>
</head>
<x-app-layout>
    <body>
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-1">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>

</x-app-layout>
@if (request()->is('customers') || request()->is('users/index'))
	<div class="pagination-sticky-item" >
		@yield('pagination')
	</div>
@endif


</html>
