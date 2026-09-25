@php
use Carbon\Carbon;
$user = auth()->user();
$userName = $user ? ($user->name ?? $user->email) : 'User';
$userRole = $user ? strtoupper($user->role ?? 'USER') : 'USER';
$todayFormatted = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
@endphp

<header id="roja-main-header" class="roja_header">
    <!-- Left: Logo & Mobile Toggle -->
    <div class="flex items-center gap-3">
        <button id="mobile-sidebar-toggle" type="button" class="md:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <a href="/dashboard" class="flex items-center">
            <img id="roja-main-header-logo" src="/assets/svg/etc/Logo.svg" alt="Pondok Roja" class="h-8 md:h-10 w-auto transition-opacity duration-300" />
        </a>
    </div>

    <!-- Center: Date Pill -->
    <div class="hidden sm:flex items-center justify-center pointer-events-none select-none">
        <span class="roja_header_date px-4 py-1.5 rounded-full text-[11px] font-semibold tracking-wide">
            {{ $todayFormatted }}
        </span>
    </div>

    <!-- Right: User Profile Menu / Logout -->
    <div class="flex items-center gap-3">
        @if(auth()->check())
            <div class="relative group">
                <button id="user-menu-btn" class="flex items-center gap-3 p-1.5 md:px-3 md:py-2 rounded-2xl hover:bg-black/5 transition-all outline-none">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="roja_header_text text-xs font-bold text-slate-800 truncate max-w-[160px]">
                            {{ $userName }}
                        </span>
                        <span class="text-[10px] font-bold text-secondary uppercase tracking-wider">
                            {{ $userRole }}
                        </span>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr($userName, 0, 1)) }}
                    </div>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-primary transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 w-56 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl border border-slate-100 p-2 z-[9999]">
                    <div class="px-3 py-2 bg-slate-50 rounded-xl mb-1 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                            {{ strtoupper(substr($userName, 0, 1)) }}
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="text-xs font-bold text-slate-800 truncate">{{ $userName }}</span>
                            <span class="text-[9px] font-bold text-secondary uppercase">{{ $userRole }}</span>
                        </div>
                    </div>
                    
                    <a href="/password" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-slate-700 hover:bg-slate-100 rounded-xl transition-colors">
                        <svg class="w-4 h-4 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        <span>Ubah Password</span>
                    </a>

                    <div class="h-px bg-slate-100 my-1"></div>

                    <a href="/logout" class="flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-danger hover:bg-rose-50 rounded-xl transition-colors">
                        <svg class="w-4 h-4 text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Keluar</span>
                    </a>
                </div>
            </div>
        @else
            <x-roja.button href="/" variant="primary" size="sm">
                Login
            </x-roja.button>
        @endif
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Header scroll background effect & logo swap
    const header = document.getElementById('roja-main-header');
    const headerLogo = document.getElementById('roja-main-header-logo');
    const logoDark = '/assets/svg/etc/Logo.svg';
    const logoLight = '/assets/svg/etc/Logo-Light.svg';

    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 15) {
                header.classList.add('scrolled');
                if (headerLogo) headerLogo.src = logoLight;
            } else {
                header.classList.remove('scrolled');
                if (headerLogo) headerLogo.src = logoDark;
            }
        });
    }

    // User Dropdown toggle
    const userBtn = document.getElementById('user-menu-btn');
    const userDropdown = document.getElementById('user-dropdown-menu');
    if (userBtn && userDropdown) {
        userBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('hidden');
        });
        document.addEventListener('click', () => {
            userDropdown.classList.add('hidden');
        });
    }

    // Mobile Sidebar Toggle
    const mobileToggle = document.getElementById('mobile-sidebar-toggle');
    const sidebar = document.getElementById('roja-sidebar');
    const sidebarOverlay = document.getElementById('roja-sidebar-overlay');
    if (mobileToggle && sidebar) {
        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            if (sidebarOverlay) sidebarOverlay.classList.toggle('hidden');
        });
    }
    if (sidebarOverlay && sidebar) {
        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    }
});
</script>
