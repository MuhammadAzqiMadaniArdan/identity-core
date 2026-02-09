<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Identity Core')</title>
    @vite('resources/css/app.css')
    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-slate-800 text-white px-8 py-5 flex justify-between items-center shadow-md">
        <div class="flex items-center gap-3">
            <img src="/images/nav-icon.svg" alt="Nav Icon" class="h-8 w-20">
            <span class="text-lg font-semibold">|</span>
            <span class="text-lg font-semibold">Login </span>
        </div>
        <div>
            <a href="#" class="font-medium hover:underline">Butuh Bantuan</a>
        </div>
    </nav>

    <!-- Main -->
    <main class="flex-1 flex flex-col md:flex-row items-center justify-center px-6 md:px-16 py-12 gap-8 bg-blue-700">
        @yield('content')
    </main>
</body>
</html>
