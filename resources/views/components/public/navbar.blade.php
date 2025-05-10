@php
    $settings = \App\Models\Setting::first();
@endphp

<header class="bg-white shadow-sm sticky top-0 z-50 border-b border-red-100">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('storeFront') }}" class="flex-shrink-0 flex items-center">
                @if($settings && $settings->logo_url)
                    <div class="h-12 md:h-16 flex items-center">
                        <img src="{{ asset('storage/' . $settings->logo_url) }}" 
                            alt="{{ $settings->company_name ?? 'Vũ Phúc Baking' }}" 
                            class="h-auto max-h-full object-contain"
                            onerror="this.src='{{ asset('images/logo.png') }}'; this.onerror=null;">
                    </div>
                @else
                    <div class="h-12 md:h-16 flex items-center">
                        <img src="{{ asset('images/logo.png') }}" 
                            alt="Vũ Phúc Baking" 
                            class="h-auto max-h-full object-contain">
                    </div>
                @endif
            </a>

            <!-- Thanh tìm kiếm - chỉ hiển thị trên desktop -->
            <div class="flex-1 mx-4 lg:mx-10 hidden md:block">
                <form action="#" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." 
                        class="w-full py-2 px-4 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500 bg-gray-50">
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-red-700 text-white rounded-full p-1.5 hover:bg-red-800 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Menu chính - chỉ hiển thị trên desktop -->
            <nav class="hidden md:flex items-center space-x-1 lg:space-x-2">
                <a href="{{ route('storeFront') }}" class="px-3 py-2 font-medium text-red-700 hover:text-white hover:bg-red-700 rounded-md transition-colors">Trang chủ</a>
                <a href="{{ route('ecomerce.index') }}" class="px-3 py-2 font-medium text-gray-700 hover:text-white hover:bg-red-700 rounded-md transition-colors">Mua hàng</a>
                <a href="{{ route('tutorial.index') }}" class="px-3 py-2 font-medium text-gray-700 hover:text-white hover:bg-red-700 rounded-md transition-colors">Khóa học</a>
                <div class="ml-2 flex items-center">
                    <a href="#" class="p-2 rounded-full hover:bg-red-50 group" aria-label="Tài khoản">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 group-hover:text-red-700 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                </div>
            </nav>

            <!-- Menu mobile (hamburger) -->
            <div class="md:hidden flex items-center gap-4">
                @if($settings && $settings->phone)
                    <a href="tel:{{ $settings->phone }}" class="p-1.5 text-red-700 bg-red-50 rounded-full hover:bg-red-100 transition-colors" aria-label="Gọi điện">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </a>
                @endif
                <button type="button" class="p-1.5 rounded-md text-red-700 bg-red-50 hover:bg-red-100 transition-colors" aria-label="Menu" id="mobile-menu-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div class="md:hidden hidden bg-white border-t" id="mobile-menu">
        <div class="py-3 space-y-1">
            <form action="#" method="GET" class="px-4 mb-3 mt-2">
                <div class="relative">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." 
                        class="w-full py-2 px-4 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500 bg-gray-50">
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-red-700 text-white rounded-full p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
            <a href="{{ route('storeFront') }}" class="block px-4 py-2 text-base font-medium text-white bg-red-700 hover:bg-red-800">Trang chủ</a>
            <a href="{{ route('ecomerce.index') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">Mua hàng</a>
            <a href="{{ route('tutorial.index') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">Khóa học</a>
            <a href="#" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">Giới thiệu</a>
            <a href="#" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">Liên hệ</a>
            <a href="#" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">Tài khoản</a>
            
            <!-- Phần thông tin liên hệ hiển thị trên mobile -->
            <div class="mt-4 pt-4 border-t border-gray-100 px-4">
                <h4 class="text-sm font-medium text-red-700 mb-3">Thông tin liên hệ:</h4>
                
                <div class="space-y-2">
                    @if($settings && $settings->email)
                    <a href="mailto:{{ $settings->email }}" class="flex items-center text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {{ $settings->email }}
                    </a>
                    @endif
                    
                    @if($settings && ($settings->address1 || $settings->address2))
                    <div class="flex items-start text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 mt-0.5 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-sm">
                            {{ $settings->address1 ?? '' }}
                            @if($settings->address1 && $settings->address2) <br> @endif
                            {{ $settings->address2 ?? '' }}
                        </span>
                    </div>
                    @endif
                </div>
                
                <!-- Social links mobile -->
                <div class="flex items-center space-x-4 mt-4">
                    @if($settings && $settings->facebook_url)
                    <a href="{{ $settings->facebook_url }}" target="_blank" class="bg-red-50 p-2 rounded-full text-red-700 hover:bg-red-100 transition-colors" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                        </svg>
                    </a>
                    @endif
                    @if($settings && $settings->youtube_url)
                    <a href="{{ $settings->youtube_url }}" target="_blank" class="bg-red-50 p-2 rounded-full text-red-700 hover:bg-red-100 transition-colors" aria-label="Youtube">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                        </svg>
                    </a>
                    @endif
                    @if($settings && $settings->zalo_url)
                    <a href="{{ $settings->zalo_url }}" target="_blank" class="bg-red-50 p-2 rounded-full hover:bg-red-100 transition-colors" aria-label="Zalo">
                        <span class="flex items-center justify-center text-xs font-bold w-4 h-4 bg-red-700 text-white rounded-sm">Z</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>