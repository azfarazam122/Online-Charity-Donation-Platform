<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full"> {{-- Add h-full to html --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col h-full font-sans antialiased"> {{-- Add h-full and flex flex-col to body --}}
    <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-700"> {{-- Keep min-h-screen and add flex flex-col --}}
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow"> {{-- Add flex-grow here --}}
            {{ $slot }}
        </main>

        {{-- FOOTER --}}
        <footer class="py-8 bg-gray-100 border-t border-gray-200 dark:bg-gray-900 dark:border-gray-700">
            <div class="px-4 mx-auto max-w-7xl text-sm text-center text-gray-500 sm:px-6 lg:px-8 dark:text-gray-400">
                <div class="mb-2">
                    <a href="{{ route('pages.terms') }}" class="mx-2 hover:underline">Terms of Service</a>
                    <span class="mx-1">•</span>
                    <a href="{{ route('pages.privacy') }}" class="mx-2 hover:underline">Privacy Policy</a>
                </div>
                <div>
                    © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
    @stack('scripts') {{-- If you have this for Chart.js or other scripts --}}
</body>

</html>
