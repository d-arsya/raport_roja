<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>
<body class="">
    @include('partials.sidebar')
    <div class="md:ml-64 pt-24 px-4 md:pt-4 pb-4 ">
        @yield('container')
    </div>
</body>
</html>