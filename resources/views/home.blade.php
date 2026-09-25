@php
    use Carbon\Carbon;
    $todayFormatted = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
    $year = Carbon::now()->isoFormat('YYYY');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Sistem Raport Login' }} - TMQ Pondok Roja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-[#17283c]">
    <!-- PageLayout (variant="center") -->
    <div class="roja_wizard_container min-h-screen flex flex-col relative overflow-x-hidden bg-[var(--bg-primary)] pt-[90px] sm:pt-[100px]">
        
        <!-- RojaHeader (Guest / Unauthenticated) -->
        <header id="roja-guest-header" class="roja_header">
            <!-- Left Logo -->
            <div class="flex items-center">
                <a href="/">
                    <img
                        id="roja-header-logo"
                        src="/assets/svg/etc/Logo.svg"
                        alt="Pondok Roja"
                        class="h-10 w-auto transition-opacity duration-300"
                    />
                </a>
            </div>

            <!-- Center Date Badge -->
            <div class="hidden sm:flex items-center justify-center pointer-events-none select-none">
                <span class="roja_header_date px-4 py-1.5 rounded-full text-[11px] font-semibold tracking-wide shadow-xs">
                    {{ $todayFormatted }}
                </span>
            </div>

            <!-- Right: Login Button -->
            <div class="flex items-center">
                <a href="/" class="roja_btn roja_btn-primary roja_btn-sm roja_header_login flex items-center gap-2 text-xs font-semibold px-5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>Login</span>
                </a>
            </div>
        </header>

        <!-- Background Blobs -->
        <div class="roja_bg_blobs" style="background-image: url('{{ asset('assets/svg/etc/Register-Bg.svg') }}');"></div>

        <!-- Main Content Area: Vertically Centered -->
        <main class="flex-1 relative z-10 px-4 sm:px-6 w-full mx-auto flex flex-col items-center justify-center my-auto py-8 sm:py-12 pt-6 pb-12 max-w-6xl">
            <div class="w-full flex flex-col items-center justify-center my-auto">
                <!-- RojaCard + AuthCard + LoginCard (1:1 with @roja/ui) -->
                <div class="roja_card_wizard relative bg-white/75 backdrop-blur-xl rounded-3xl border border-white/40 shadow-[0_8px_32px_rgba(31,38,135,0.05)] p-8 md:p-12 transition-all duration-300 flex flex-col gap-6 w-full max-w-md mx-auto my-8">
                    <!-- Glows -->
                    <div class="absolute inset-0 rounded-3xl overflow-hidden pointer-events-none z-0">
                        <div class="absolute -top-12 -left-12 w-48 h-48 bg-[var(--primary)] rounded-full blur-[50px] opacity-[0.12] pointer-events-none"></div>
                        <div class="absolute -top-12 -right-12 w-48 h-48 bg-[var(--secondary)] rounded-full blur-[50px] opacity-[0.12] pointer-events-none"></div>
                    </div>

                    <div class="relative z-10 w-full flex flex-col gap-6">
                        <!-- Logo & Header -->
                        <div class="flex flex-col gap-2 items-center text-center">
                            <img src="/assets/svg/etc/Logo.svg" alt="Pondok Roja" class="h-14 w-auto mb-2" />
                            <div class="text-xs font-bold text-[var(--primary)] tracking-wide m-0">
                                Sistem Raport Login
                            </div>
                            <div class="text-xs text-[var(--body-txt-inverse)] text-slate-500 m-0 leading-relaxed">
                                Masuk untuk mengelola data raport dan nilai santri
                            </div>
                        </div>

                        <!-- Alerts -->
                        @if($errors->any() || session('error'))
                            <div class="roja_alert-danger relative w-full rounded-2xl border-0 p-3.5 px-4 font-semibold text-xs flex items-center gap-2 shadow-none transition-all">
                                <svg class="w-4 h-4 shrink-0 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('error') ?? $errors->first('error') ?? $errors->first('email') ?? 'Gagal masuk. Periksa email & kata sandi Anda.' }}</span>
                            </div>
                        @endif

                        <!-- Form -->
                        <form action="/" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <div class="flex flex-col gap-1.5">
                                <input
                                    id="login-identifier"
                                    type="text"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Email / Nomor Akun"
                                    class="form-control h-11 text-xs rounded-xl border-slate-200"
                                    required
                                    autofocus
                                />
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <input
                                    id="login-password"
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    class="form-control h-11 text-xs rounded-xl border-slate-200"
                                    required
                                />
                                <div class="flex justify-between items-center text-xs pt-0.5">
                                    <div class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            id="login-remember"
                                            name="remember"
                                            class="rounded border-slate-300 text-primary focus:ring-primary w-4 h-4 cursor-pointer"
                                        />
                                        <label for="login-remember" class="text-slate-600 font-medium cursor-pointer text-xs select-none">
                                            Remember Me
                                        </label>
                                    </div>

                                    <a href="/password" class="text-[11px] text-[var(--secondary)] hover:underline font-medium ml-auto">
                                        Lupa Password?
                                    </a>
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="roja_btn roja_btn-primary font-semibold h-11 rounded-md px-8 w-full mt-2 cursor-pointer text-xs"
                            >
                                Masuk
                            </button>
                        </form>

                        <!-- Card Footer -->
                        <div class="text-center text-xs border-t border-[var(--bg-form-border)] border-slate-100 pt-4 text-slate-500">
                            Butuh bantuan akun? <a href="/password" class="text-[var(--secondary)] hover:underline font-semibold">Lupa Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Redesigned Modern Centered Footer -->
        <footer class="w-full bg-white/70 backdrop-blur-md border-t border-[var(--bg-form-border)] py-2 mt-auto relative z-10 shadow-[0_-1px_3px_rgba(0,0,0,0.02)]">
            <div class="w-full max-w-[1140px] mx-auto px-4 sm:px-6 flex flex-col items-center justify-center gap-2 text-center">
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                    <span class="w-2 h-2 rounded-full bg-[#e4007e]"></span>
                    <span>TMQ PONDOK ROJA</span>
                </div>
                <p class="text-[11px] text-[#abb4be] font-medium leading-relaxed m-0 max-w-2xl">
                    © Copyright {{ $year }}
                </p>
            </div>
        </footer>
    </div>

    <!-- Header Scroll Script (Logo switch & Pink backdrop blur) -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const header = document.getElementById('roja-guest-header');
        const logo = document.getElementById('roja-header-logo');
        const logoDark = '/assets/svg/etc/Logo.svg';
        const logoLight = '/assets/svg/etc/Logo-Light.svg';

        if (header && logo) {
            const handleScroll = () => {
                const scrollTop = window.scrollY || document.documentElement.scrollTop || document.body.scrollTop;
                if (scrollTop > 10) {
                    header.classList.add('scrolled');
                    logo.src = logoLight;
                } else {
                    header.classList.remove('scrolled');
                    logo.src = logoDark;
                }
            };
            window.addEventListener('scroll', handleScroll, { passive: true });
            handleScroll();
        }
    });
    </script>
</body>
</html>
