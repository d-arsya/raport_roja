<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-slate-100">
        <a href="" class="flex items-center justify-center mb-5">
            <img src="{{ Storage::url('assets/logo.png') }}" class="me-3" />
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/dashboard"
                    class="{{ $active == 'dashboard' ? 'bg-pink-600 text-white' : 'text-pink-600' }} flex items-center p-2 rounded-lg hover:bg-pink-600 hover:text-white group">
                    <svg class="w-5 h-5 {{ $active == 'dashboard' ? 'text-white' : 'text-pink-600' }} transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            @if (!in_array(auth()->user()->role,['super','student']))
            <li>
                <a href="/kelas"
                        class="flex items-center p-2 {{ $active == 'kelas' ? 'bg-pink-600 text-white' : 'text-pink-600' }} rounded-lg hover:bg-pink-600 hover:text-white group">
                        <svg class="flex-shrink-0 w-5 h-5 {{ $active == 'kelas' ? 'bg-pink-600 text-white' : 'text-pink-600' }} transition duration-75 group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Kelas</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role == 'admin')
                <li>
                    <a href="/guru"
                        class="flex items-center p-2 {{ $active == 'guru' ? 'bg-pink-600 text-white' : 'text-pink-600' }} rounded-lg hover:bg-pink-600 hover:text-white group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="flex-shrink-0 w-5 h-5 {{ $active == 'guru' ? 'bg-pink-600 text-white' : 'text-pink-600' }} transition duration-75 group-hover:text-white"
                            width="16" height="16" fill="currentColor" class="bi bi-person-raised-hand"
                            viewBox="0 0 16 16">
                            <path
                                d="M6 6.207v9.043a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H6.236a1 1 0 0 1-.447-.106l-.33-.165A.83.83 0 0 1 5 2.488V.75a.75.75 0 0 0-1.5 0v2.083c0 .715.404 1.37 1.044 1.689L5.5 5c.32.32.5.754.5 1.207" />
                            <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Guru</span>
                    </a>
                </li>
                <li>
                    <a href="/siswa"
                        class="flex items-center p-2 {{ $active == 'siswa' ? 'bg-pink-600 text-white' : 'text-pink-600' }} rounded-lg hover:bg-pink-600 hover:text-white group">
                        <svg class="flex-shrink-0 w-5 h-5 {{ $active == 'siswa' ? 'bg-pink-600 text-white' : 'text-pink-600' }} transition duration-75 group-hover:text-white"
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="/grup"
                        class="flex items-center p-2 {{ $active == 'grup' ? 'bg-pink-600 text-white' : 'text-pink-600' }} rounded-lg hover:bg-pink-600 hover:text-white group">
                        <svg class="flex-shrink-0 w-5 h-5 {{ $active == 'grup' ? 'bg-pink-600 text-white' : 'text-pink-600' }} transition duration-75 group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Group Siswa</span>
                    </a>
                </li>
            @endif
            @if (in_array(auth()->user()->role, ['admin', 'teacher']))
                <li>
                    <a href="/pelajaran"
                        class="flex items-center p-2 {{ $active == 'pelajaran' ? 'bg-pink-600 text-white' : 'text-pink-600' }} rounded-lg hover:bg-pink-600 hover:text-white group">
                        <svg class="flex-shrink-0 w-5 h-5 {{ $active == 'pelajaran' ? 'bg-pink-600 text-white' : 'text-pink-600' }} transition duration-75 group-hover:text-white"
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-book-half" viewBox="0 0 16 16">
                            <path
                                d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Pelajaran</span>
                    </a>
                </li>
            @endif
            @if (in_array(auth()->user()->role, ['student', 'teacher']))
                <li>
                    <a href="/nilai"
                        class="flex items-center p-2 {{ $active == 'nilai' ? 'bg-pink-600 text-white' : 'text-pink-600' }} rounded-lg hover:bg-pink-600 hover:text-white group">
                        <svg class="flex-shrink-0 w-5 h-5 {{ $active == 'nilai' ? 'bg-pink-600 text-white' : 'text-pink-600' }} transition duration-75 group-hover:text-white"
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
                            <path
                                d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
                            <path
                                d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Nilai</span>
                    </a>
                </li>
                @endif
                <li>
                <a href="/logout"
                    class="flex items-center p-2 {{ $active == 'logout' ? 'bg-pink-600 text-white' : 'text-pink-600' }} rounded-lg hover:bg-pink-600 hover:text-white group">
                    <svg class="flex-shrink-0 w-5 h-5 {{ $active == 'logout' ? 'bg-pink-600 text-white' : 'text-pink-600' }} transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

</div>
<div class="block fixed w-full sm:hidden">
    <nav class="bg-white border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ Storage::url('assets/logo.png') }}" class="h-8" />
            </a>
            <button id="burger-menu-button" data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-pink-600 rounded-lg md:hidden hover:bg-pink-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
        </svg>
    </button>
    <div id="navbar-default" class="hidden fixed top-12 w-full md:w-auto">
        <ul
        class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md dark:border-gray-700">
        <li>
            <a href="/dashboard"
            class="block py-2 px-3 text-pink-600 rounded hover:bg-pink-600 hover:text-white md:bg-transparent md:text-blue-700 md:p-0"
            aria-current="page">Dashboard</a>
        </li>
        @if (!in_array(auth()->user()->role,['super','student']))
        <li>
                            <a href="/kelas"
                                class="block py-2 px-3 text-pink-600 rounded hover:bg-pink-600 hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-blue-700">Kelas</a>
                        </li>
                    @endif
                    @if (auth()->user()->role == 'admin')
                        <li>
                            <a href="/guru"
                                class="block py-2 px-3 text-pink-600 rounded hover:bg-pink-600 hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-blue-700">Guru</a>
                        </li>
                        <li>
                            <a href="/siswa"
                                class="block py-2 px-3 text-pink-600 rounded hover:bg-pink-600 hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-blue-700">Siswa</a>
                        </li>
                        <li>
                            <a href="/grup"
                                class="block py-2 px-3 text-pink-600 rounded hover:bg-pink-600 hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-blue-700">Group
                                Siswa</a>
                        </li>
                    @endif
                    @if (in_array(auth()->user()->role, ['admin', 'teacher']))
                        <li>
                            <a href="/pelajaran"
                                class="block py-2 px-3 text-pink-600 rounded hover:bg-pink-600 hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-blue-700">Pelajaran</a>
                        </li>
                    @endif
                    @if (in_array(auth()->user()->role, ['student', 'teacher']))
                        <li>
                            <a href="/nilai"
                                class="block py-2 px-3 text-pink-600 rounded hover:bg-pink-600 hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-blue-700">Nilai</a>
                        </li>
                    @endif
                    <li>
                        <a href="/logout"
                            class="block py-2 px-3 text-pink-600 rounded hover:bg-pink-600 hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-blue-700">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('burger-menu-button').addEventListener('click', function() {
            var menu = document.getElementById('navbar-default');
            menu.classList.toggle('hidden');
        });
    </script>


</div>
