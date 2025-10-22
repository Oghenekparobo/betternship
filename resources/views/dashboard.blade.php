<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <section>
        @if (session()->has('username'))
        <h1 class="text-2xl text-white">{{ session('username') }}</h1>

        <!-- bonus -->
        <form method="get" action="/logout">
            @csrf
            <button type="submit" class="text-white underline">Logout</button>
            @else
            <h1 class="text-2xl text-white mb-4">Please log in</h1>


            <a href="/login"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">
                Login
            </a>


            <p class="mt-3 text-gray-400">
                Don’t have an account?
                <a href="/registration" class="underline text-blue-400 hover:text-blue-500">Register here</a>
            </p>
            @endif

    </section>
</body>