@php
$active = $active ?? '';
$role = auth()->user()->role ?? '';

$menuItems = [
    [
        'id' => 'dashboard',
        'label' => 'Dashboard',
        'url' => '/dashboard',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />',
        'color' => 'text-primary',
        'bg' => 'bg-primary/10',
        'visible' => true,
    ],
    [
        'id' => 'kelas',
        'label' => 'Kelas',
        'url' => '/kelas',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />',
        'color' => 'text-secondary',
        'bg' => 'bg-secondary/10',
        'visible' => !in_array($role, ['super', 'student']),
    ],
    [
        'id' => 'guru',
        'label' => 'Guru',
        'url' => '/guru',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />',
        'color' => 'text-tertiary',
        'bg' => 'bg-tertiary/10',
        'visible' => in_array($role, ['admin']),
    ],
    [
        'id' => 'siswa',
        'label' => 'Siswa',
        'url' => '/siswa',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
        'color' => 'text-info',
        'bg' => 'bg-info/10',
        'visible' => in_array($role, ['admin']),
    ],
    [
        'id' => 'grup',
        'label' => 'Group Siswa',
        'url' => '/grup',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />',
        'color' => 'text-quaternary',
        'bg' => 'bg-quaternary/20',
        'visible' => in_array($role, ['admin']),
    ],
    [
        'id' => 'pelajaran',
        'label' => 'Pelajaran',
        'url' => '/pelajaran',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
        'color' => 'text-warning',
        'bg' => 'bg-warning/10',
        'visible' => in_array($role, ['admin', 'teacher']),
    ],
    [
        'id' => 'nilai',
        'label' => 'Nilai',
        'url' => '/nilai',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />',
        'color' => 'text-primary',
        'bg' => 'bg-primary/10',
        'visible' => in_array($role, ['student', 'teacher', 'admin']),
    ],
];
@endphp

<!-- Backdrop overlay for mobile -->
<div id="roja-sidebar-overlay" class="hidden fixed inset-0 bg-black/40 z-30 md:hidden backdrop-blur-xs"></div>

<!-- Sidebar Container -->
<aside id="roja-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 pb-4 px-4 transition-transform -translate-x-full md:translate-x-0 flex flex-col justify-between overflow-y-auto">
    <div class="flex flex-col gap-2.5">
        @foreach($menuItems as $item)
            @if($item['visible'])
                @php
                    $isActive = ($active == $item['id']);
                @endphp
                <a
                    href="{{ $item['url'] }}"
                    class="group relative flex items-center justify-between px-4 py-3 rounded-2xl bg-white border-0 shadow-[0_4px_16px_rgba(0,0,0,0.03)] hover:shadow-md transition-all duration-200 cursor-pointer overflow-hidden {{ $isActive ? 'text-slate-900 font-bold' : 'text-slate-500 font-medium hover:text-slate-800' }}"
                >
                    <!-- Left Pink Accent Active Line -->
                    @if($isActive)
                        <span class="absolute left-0 top-0 bottom-0 w-1.5 bg-primary rounded-l-2xl"></span>
                    @endif

                    <div class="flex items-center gap-3">
                        <!-- Icon Box -->
                        <div class="w-8 h-8 rounded-xl {{ $item['bg'] }} {{ $item['color'] }} flex items-center justify-center shrink-0 transition-transform duration-200 group-hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $item['icon'] !!}
                            </svg>
                        </div>

                        <!-- Label -->
                        <span class="text-xs tracking-wide">{{ $item['label'] }}</span>
                    </div>

                    @if($isActive)
                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                    @endif
                </a>
            @endif
        @endforeach
    </div>

    <!-- Bottom Section: Logout -->
    <div class="pt-4 border-t border-slate-200/60">
        <a
            href="/logout"
            class="group relative flex items-center gap-3 px-4 py-3 rounded-2xl bg-white/70 hover:bg-rose-50 text-slate-500 hover:text-danger font-medium transition-all duration-200"
        >
            <div class="w-8 h-8 rounded-xl bg-danger/10 text-danger flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
            <span class="text-xs font-semibold">Keluar</span>
        </a>
    </div>
</aside>
