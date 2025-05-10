<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="canonical" href="https://vuphucbaking.com">
    <meta name="description"
        content="Vũ Phúc Baking - Nhà phân phối nguyên phụ liệu, dụng cụ, thiết bị ngành bánh, pha chế, nhà hàng tại khu vực ĐBSCL. Nhà phân phối độc quyền các sản phẩm Rich Products Vietnam khu vực Tây Nam.">
    <meta name="keywords"
        content="Vũ Phúc Baking, nguyên liệu ngành bánh, pha chế, nhà hàng, ĐBSCL, Rich Products Vietnam, dụng cụ làm bánh, thiết bị pha chế">
    <meta name="robots" content="all">
    <meta property="og:title" content="Vũ Phúc Baking - Nhà phân phối nguyên liệu ngành bánh và pha chế">
    <meta property="og:description"
        content="Vũ Phúc Baking - Nhà phân phối nguyên phụ liệu, dụng cụ, thiết bị ngành bánh, pha chế, nhà hàng tại khu vực ĐBSCL. Nhà phân phối độc quyền các sản phẩm Rich Products Vietnam khu vực Tây Nam.">
    <meta property="og:url" content="https://vuphucbaking.com">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Vũ Phúc Baking - Nhà phân phối nguyên liệu ngành bánh và pha chế",
  "description": "Vũ Phúc Baking cung cấp nguyên phụ liệu, dụng cụ, thiết bị ngành bánh, pha chế, nhà hàng tại khu vực ĐBSCL, với vai trò nhà phân phối độc quyền các sản phẩm Rich Products Vietnam khu vực Tây Nam.",
  "url": "https://vuphucbaking.com"
}
</script>
    <meta name="revisit-after" content="1 day">
    <meta name="HandheldFriendly" content="true">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <meta name="author" content="Manh Hieu">
    <meta name="theme-color" content="#b91c1c">

    <!-- Preconnects & Preloads -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts - Montserrat & Open Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ $settings->logo_url ? asset('storage/' . $settings->logo_url) : asset('images/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ $settings->logo_url ? asset('storage/' . $settings->logo_url) : asset('images/logo.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ $settings->logo_url ? asset('storage/' . $settings->logo_url) : asset('images/logo.png') }}">

    <title>{{ config('app.name') }}</title>

    <style>
        :root {
            --primary: #b91c1c;
            --primary-dark: #991b1b;
            --secondary: #1f2937;
            --light: #f9fafb;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-light: #f3f4f6;
        }
        
        [x-cloak] {
            display: none !important;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Open Sans', system-ui, sans-serif;
            color: #374151;
        }
        
        h1, h2, h3, h4, h5, h6, .heading {
            font-family: 'Montserrat', system-ui, sans-serif;
        }
        
        .section-transition {
            transition: all 0.5s ease-in-out;
        }
        
        .section-transition:hover {
            transform: translateY(-5px);
        }
        
        .text-primary {
            color: var(--primary);
        }
        
        .bg-primary {
            background-color: var(--primary);
        }
        
        .transition-transform {
            transition-property: transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
        
        .hover-up:hover {
            transform: translateY(-5px);
        }
        
        .page-container {
            max-width: 1440px;
            margin-left: auto;
            margin-right: auto;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.7s ease-out forwards;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
    @stack('styles')

</head>

<body class="antialiased min-h-screen flex flex-col">
    <!-- Preloader - Optional -->
    <div id="page-preloader" class="fixed inset-0 bg-white z-50 flex items-center justify-center transition-opacity duration-500">
        <div class="loader-content flex flex-col items-center">
            <img src="{{ $settings->logo_url ? asset('storage/' . $settings->logo_url) : asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="h-16 w-auto mb-4 animate-pulse">
            <div class="w-32 h-1 bg-gradient-to-r from-red-700 to-red-500 rounded-full animate-pulse"></div>
        </div>
    </div>

    <!-- Top Navigation Bar -->
    @include('components.public.subnav')
    
    <!-- Main Navigation -->
    @include('components.public.navbar')
    
    <!-- Main Content -->
    <main class="flex-grow bg-gray-50 overflow-hidden">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.public.footer')
    
    <!-- Action Buttons -->
    @include('components.public.speedial')
    
    <!-- Notifications -->
    @livewire('notifications')
    
    <!-- Scripts -->
    @filamentScripts
    @vite('resources/js/app.js')
    @stack('scripts')
    
    <script>
        // Preloader
        document.addEventListener('DOMContentLoaded', function() {
            const preloader = document.getElementById('page-preloader');
            if (preloader) {
                setTimeout(() => {
                    preloader.style.opacity = 0;
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 500);
                }, 500);
            }
            
            // Animate sections on scroll
            const animateSections = document.querySelectorAll('.animate-on-scroll');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            animateSections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
</body>
</html>
