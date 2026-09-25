<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Academic Report' }} - TMQ Pondok Roja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="roja_wizard_container min-h-screen flex flex-col relative overflow-x-hidden bg-[var(--bg-primary)] font-sans antialiased text-[#17283c]">
    <!-- Header -->
    @include('partials.header')

    <!-- Background Blobs -->
    <div class="roja_bg_blobs" style="background-image: url('{{ asset('assets/svg/etc/Register-Bg.svg') }}');"></div>

    <div class="flex-1 flex pt-[70px] relative z-10">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content Area -->
        <main class="flex-1 md:ml-64 p-4 md:p-6 pb-12 w-full max-w-7xl mx-auto">
            @yield('container')
        </main>
    </div>

    <!-- Footer -->
    @include('partials.footer')
</body>
</html>