<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-x-hidden">

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
    <meta property="og:image"
        content="{{ asset('images/logo.png') }}">
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
    <meta name="theme-color" content="#ffffff">

    <!-- Thẻ tạo icon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <title>{{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')

</head>

<body class="antialiased overflow-x-hidden">

    {{-- @include('component.shop.navbar') --}}
    <main class="bg-gray-100 overflow-x-hidden">
        @yield('content')
    </main>
    {{-- @include('component.shop.footer')
@include('component.shop.speedial') --}}
    {{-- @include('component.shop.modal') --}}

    @livewire('notifications')

    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
