<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

        <!-- Style -->
        <style>
            /* Mencegah scroll */
            html, body {
                overflow: hidden;
                height: 100%;
            }
            /* Pastikan konten penuh di layar */
            .min-h-screen {
                height: 100vh;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 dark:bg-gray-900 relative overflow-hidden">
        <!-- Background Decorative Element -->
        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 bg-heroLight dark:bg-heroDark bg-no-repeat bg-top bg-cover w-full h-full -z-[1]"></div>

        <div class="min-h-screen container grid place-items-center relative">
            <!-- Slot Content -->
            <div>
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="absolute bottom-4 text-center text-sm text-gray-600 dark:text-gray-400 w-full">
                &copy; Portofolio Ibnu. All rights reserved.
            </div>
        </div>
    </body>
</html>
