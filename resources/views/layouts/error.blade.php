<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lỗi - ' . config('app.name'))</title>
    <meta name="description" content="@yield('description', 'Đã xảy ra lỗi. Vui lòng thử lại sau.')">
    <meta name="robots" content="noindex, nofollow">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --primary: #b91c1c; }
        body { font-family: 'Open Sans', sans-serif; color: #374151; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Montserrat', sans-serif; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="antialiased min-h-screen bg-gray-50">
    <main class="min-h-screen">@yield('content')</main>
    @stack('scripts')
</body>
</html>
