<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/profile.jpg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="font-sans text-slate-900 antialiased bg-white">
    <div class="min-h-screen flex">
        <div
            class="w-full lg:w-1/2 flex items-center justify-center px-6 sm:px-8 py-12 bg-white shadow-2xl lg:shadow-none z-20">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>

        <div
            class="hidden lg:flex lg:w-1/2 relative items-stretch justify-center rounded-2xl xl:rounded-l-3xl overflow-hidden m-6">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-700 via-slate-800 to-slate-900 z-0"></div>

            <div class="absolute inset-0 opacity-40 z-1"> {{-- Opasitas sedikit disesuaikan --}}
                <svg class="absolute bottom-0 w-full h-auto max-h-full" viewBox="0 0 400 300"
                    preserveAspectRatio="xMidYEnd slice">
                    <path d="M0,200 Q100,120 200,140 Q300,160 400,100 L400,300 L0,300 Z"
                        fill="rgba(255,255,255,0.03)" />
                </svg>
                <svg class="absolute bottom-0 w-full h-auto max-h-full" viewBox="0 0 400 300"
                    preserveAspectRatio="xMidYEnd slice">
                    <path d="M0,250 Q80,180 160,200 Q240,220 320,170 Q360,150 400,160 L400,300 L0,300 Z"
                        fill="rgba(255,255,255,0.05)" />
                </svg>
                <svg class="absolute bottom-0 w-full h-auto max-h-full" viewBox="0 0 400 300"
                    preserveAspectRatio="xMidYEnd slice">
                    <path
                        d="M0,280 Q60,220 120,240 Q180,260 240,230 Q300,200 360,210 Q380,215 400,220 L400,300 L0,300 Z"
                        fill="rgba(255,255,255,0.07)" />
                </svg>
            </div>

            <div class="absolute inset-0 flex items-center justify-center p-8 z-5 pointer-events-none">
                <img src="{{ asset('images/btc.svg') }}" alt="Ilustrasi" class="w-80 h-80 mx-auto">
            </div>

            <div class="absolute bottom-0 left-0 p-8 sm:p-12 z-10">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-3 leading-tight drop-shadow-md">
                    Selamat Datang Kembali!
                </h2>
                <p class="text-base sm:text-lg text-slate-200 max-w-sm drop-shadow-md">
                    Masuk untuk melanjutkan ke Admin Panel dan kelola konten Anda.
                </p>
                <div class="mt-6 sm:mt-8 flex space-x-2">
                    <div class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-white opacity-50"></div>
                    <div class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-white"></div>
                    <div class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-white opacity-50"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
