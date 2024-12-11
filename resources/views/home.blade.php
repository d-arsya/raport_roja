@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100 overflow-y-hidden">
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
          <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ Storage::url('assets/logo.png') }}" class="h-12" alt="Flowbite Logo" />
          </a>
          <div class="text-slate-300 font-semibold text-sm p-2 rounded-md bg-slate-100 ">
            {{ Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}
          </div>
        </div>
      </nav>
    <section class="bg-no-repeat bg-cover bg-slate-100" style="background-image: url('{{ Storage::url('assets/background.svg') }}')">
        <div class="flex flex-col items-center px-6 mx-auto pb-72 pt-24">
            <div class="w-full bg-white rounded-2xl drop-shadow-2xl md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-8 md:space-y-6 sm:p-8">
                    <h1 class="text-center font-bold text-2xl text-pink-600">Login</h1>
                    <h1 class="text-xs text-center font-semibold text-slate-400">
                        Silakan login untuk masuk ke sistem raport.
                    </h1>
                    @error('error')
                    <div class="bg-red-300 italic rounded-lg p-3">Periksa kembali data anda</div>
                        
                    @enderror
                    <form class="space-y-4 md:space-y-6" action="/" method="POST">
                        @csrf
                        <div>
                            <input type="text" name="email" id="email"
                                class="text-sm font-medium border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Email" required="">
                        </div>
                        <div>
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="text-sm font-medium border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <a href="#"
                            class="hidden text-sm font-medium text-lime-400 hover:underline"><h1 class="text-end">Forgot
                                password?
                                </h1></a>
                                <div class="flex justify-center">
                                    <button type="submit"
                                        class="drop-shadow-2xl text-white bg-pink-600 hover:bg-pink-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                                        <img src="{{ Storage::url('assets/login.svg') }}" alt="" class="inline mr-2">
                                        Login
                                    </button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="fixed bottom-0 bg-slate-100 text-center p-5 w-full">
        <h1 class="text-xs md:text-sm text-slate-600 font-semibold">© Copyright {{ Carbon::now()->isoFormat('YYYY') }} TARBIYYATU MUHAFFIZHATIL QUR'AN PONDOK ROOIHATUL JANNAH. All Rights Reserved.</h1>
    </footer>
</body>
</html>
