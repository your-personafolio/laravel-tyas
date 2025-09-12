<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <title>Portfolio</title>
</head>
<body>
    <x-admin.sidebar></x-admin.sidebar>

    <main class="pl-52 w-full">
        <x-admin.navbar></x-admin.navbar>
        
        <div class="p-4">
            {{ $slot }}
        </div>
    </main>

</body>