@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ganti Password</title>
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
                <div class="p-6 space-y-8 flex flex-col">
                    <h1 class="text-center font-bold text-2xl text-pink-600">Ganti Password</h1>                    
                    <div class="bg-red-300 italic rounded-lg p-3 mb-4">Silahkan ganti password bawaan anda untuk menggunakan fitur ini</div>
                    <a href="/dashboard" class="bg-pink-600 rounded-lg p-3 text-center text-white font-bold hover:bg-pink-700">Kembali</a>
                </div>
            </div>
        </div>
    </section>
    <footer class="fixed bottom-0 bg-slate-100 text-center p-5 w-full">
        <h1 class="text-xs md:text-sm text-slate-600 font-semibold">© Copyright {{ Carbon::now()->isoFormat('YYYY') }} TARBIYYATU MUHAFFIZHATIL QUR'AN PONDOK ROOIHATUL JANNAH. All Rights Reserved.</h1>
    </footer>
</body>
</html>
