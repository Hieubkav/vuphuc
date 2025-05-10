@php
    use App\Models\Product;
    $featuredProducts = Product::where('status', 1)
                            ->where('featured', 1)
                            ->orderBy('order')
                            ->take(8)
                            ->get();
    $productsCount = $featuredProducts->count();
@endphp

@if($productsCount > 0)
<section class="py-8 md:py-16 bg-gray-50" id="products">
    <div class="container mx-auto px-4">
        <!-- Tiêu đề chung -->
        <div class="text-center mb-6 md:mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Sản phẩm nổi bật</h2>
            <div class="w-16 md:w-24 h-1 bg-red-700 mx-auto mt-2 md:mt-4 mb-3 md:mb-6"></div>
            <p class="text-sm md:text-base text-gray-600 max-w-2xl mx-auto">Khám phá các sản phẩm chất lượng cao được khách hàng tin dùng và đánh giá cao</p>
        </div>

        <!-- MOBILE VERSION - Hiển thị chỉ trên thiết bị di động (dưới md) -->
        <div class="md:hidden">
            @if($productsCount <= 4)
            <!-- Grid layout cho 1-4 sản phẩm trên mobile -->
            <div class="grid grid-cols-2 gap-3">
                @foreach($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <a href="#" class="block relative h-36 overflow-hidden">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="object-cover w-full h-full">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            
                            @if($product->hasDiscount())
                                <div class="absolute top-1 right-1 bg-red-600 text-white px-1.5 py-0.5 rounded text-xs font-medium">
                                    -{{ $product->getDiscountPercentage() }}%
                                </div>
                            @endif
                        </a>
                        <div class="p-3">
                            <h3 class="font-medium text-sm text-gray-900 mb-1 line-clamp-2 h-10">
                                <a href="#">{{ $product->name }}</a>
                            </h3>
                            <div class="flex justify-between items-center mt-2">
                                <div>
                                    @if($product->price && $product->price > 0)
                                        @if($product->hasDiscount())
                                            <span class="text-red-600 font-medium text-sm">{{ number_format($product->sale_price) }}đ</span>
                                            <span class="text-gray-400 line-through text-xs ml-1">{{ number_format($product->price) }}đ</span>
                                        @else
                                            <span class="text-red-600 font-medium text-sm">{{ number_format($product->price) }}đ</span>
                                        @endif
                                    @endif
                                </div>
                                <a href="#" class="inline-block text-xs text-white bg-red-600 hover:bg-red-700 px-2 py-1 rounded transition-colors">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <!-- Carousel cho 5+ sản phẩm trên mobile -->
            <div class="products-mobile-container overflow-hidden relative">
                <div class="swiper-container products-swiper">
                    <div class="swiper-wrapper">
                        @foreach($featuredProducts as $product)
                            <div class="swiper-slide">
                                <div class="bg-white rounded-lg shadow-sm overflow-hidden mx-1">
                                    <a href="#" class="block relative h-40 overflow-hidden">
                                        @if($product->thumbnail)
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="object-cover w-full h-full">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        @if($product->hasDiscount())
                                            <div class="absolute top-1 right-1 bg-red-600 text-white px-1.5 py-0.5 rounded text-xs font-medium">
                                                -{{ $product->getDiscountPercentage() }}%
                                            </div>
                                        @endif
                                    </a>
                                    <div class="p-3">
                                        <h3 class="font-medium text-sm text-gray-900 mb-1 line-clamp-2 h-10">
                                            <a href="#">{{ $product->name }}</a>
                                        </h3>
                                        <div class="flex justify-between items-center mt-2">
                                            <div>
                                                @if($product->price && $product->price > 0)
                                                    @if($product->hasDiscount())
                                                        <span class="text-red-600 font-medium text-sm">{{ number_format($product->sale_price) }}đ</span>
                                                        <span class="text-gray-400 line-through text-xs ml-1">{{ number_format($product->price) }}đ</span>
                                                    @else
                                                        <span class="text-red-600 font-medium text-sm">{{ number_format($product->price) }}đ</span>
                                                    @endif
                                                @endif
                                            </div>
                                            <a href="#" class="inline-block text-xs text-white bg-red-600 hover:bg-red-700 px-2 py-1 rounded transition-colors">
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Điều hướng carousel mobile -->
                <div class="flex items-center justify-center mt-4 space-x-2">
                    <button class="products-prev-mobile w-8 h-8 flex items-center justify-center rounded-full bg-white shadow text-gray-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div class="swiper-pagination products-pagination"></div>
                    <button class="products-next-mobile w-8 h-8 flex items-center justify-center rounded-full bg-white shadow text-gray-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            @endif
            
            <!-- Nút xem thêm cho mobile -->
            <div class="text-center mt-6">
                <a href="#" class="inline-flex items-center justify-center w-full py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition">
                    <span>Xem tất cả sản phẩm</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- DESKTOP VERSION - Hiển thị chỉ từ md trở lên -->
        <div class="hidden md:block">
            @if($productsCount <= 8)
            <!-- Grid layout cho 1-8 sản phẩm trên desktop -->
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-all hover:-translate-y-1 hover:shadow-md duration-300">
                        <a href="#" class="block relative h-56 lg:h-64 overflow-hidden">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="object-cover w-full h-full transition-transform hover:scale-105 duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            
                            @if($product->hasDiscount())
                                <div class="absolute top-3 right-3 bg-red-600 text-white px-2 py-1 rounded-md text-xs font-medium">
                                    -{{ $product->getDiscountPercentage() }}%
                                </div>
                            @endif
                        </a>
                        <div class="p-5">
                            <div class="mb-2">
                                @if($product->productCategory)
                                    <span class="text-sm text-gray-500">{{ $product->productCategory->name }}</span>
                                @endif
                            </div>
                            <h3 class="font-medium text-lg text-gray-900 mb-3 line-clamp-2 h-14">
                                <a href="#" class="hover:text-red-700">{{ $product->name }}</a>
                            </h3>
                            <div class="flex justify-between items-center mt-4">
                                <div>
                                    @if($product->price && $product->price > 0)
                                        @if($product->hasDiscount())
                                            <span class="text-red-600 font-bold text-lg">{{ number_format($product->sale_price) }}đ</span>
                                            <span class="text-gray-400 line-through text-base ml-2">{{ number_format($product->price) }}đ</span>
                                        @else
                                            <span class="text-red-600 font-bold text-lg">{{ number_format($product->price) }}đ</span>
                                        @endif
                                    @endif
                                </div>
                                <a href="#" class="inline-block text-sm text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md transition-colors" title="Xem chi tiết">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <!-- Carousel cho 9+ sản phẩm trên desktop -->
            <div class="swiper-container desktop-products-swiper overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach($featuredProducts as $product)
                        <div class="swiper-slide">
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-all hover:-translate-y-1 hover:shadow-md duration-300 h-full mx-1.5">
                                <a href="#" class="block relative h-56 lg:h-64 overflow-hidden">
                                    @if($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="object-cover w-full h-full transition-transform hover:scale-105 duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    @if($product->hasDiscount())
                                        <div class="absolute top-3 right-3 bg-red-600 text-white px-2 py-1 rounded-md text-xs font-medium">
                                            -{{ $product->getDiscountPercentage() }}%
                                        </div>
                                    @endif
                                </a>
                                <div class="p-5">
                                    <div class="mb-2">
                                        @if($product->productCategory)
                                            <span class="text-sm text-gray-500">{{ $product->productCategory->name }}</span>
                                        @endif
                                    </div>
                                    <h3 class="font-medium text-lg text-gray-900 mb-3 line-clamp-2 h-14">
                                        <a href="#" class="hover:text-red-700">{{ $product->name }}</a>
                                    </h3>
                                    <div class="flex justify-between items-center mt-4">
                                        <div>
                                            @if($product->price && $product->price > 0)
                                                @if($product->hasDiscount())
                                                    <span class="text-red-600 font-bold text-lg">{{ number_format($product->sale_price) }}đ</span>
                                                    <span class="text-gray-400 line-through text-base ml-2">{{ number_format($product->price) }}đ</span>
                                                @else
                                                    <span class="text-red-600 font-bold text-lg">{{ number_format($product->price) }}đ</span>
                                                @endif
                                            @endif
                                        </div>
                                        <a href="#" class="inline-block text-sm text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md transition-colors" title="Xem chi tiết">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Điều hướng carousel desktop -->
                <div class="flex items-center justify-center mt-8 space-x-4">
                    <button class="products-prev-desktop w-12 h-12 flex items-center justify-center rounded-full bg-white shadow text-gray-700 hover:text-red-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div class="swiper-pagination desktop-products-pagination"></div>
                    <button class="products-next-desktop w-12 h-12 flex items-center justify-center rounded-full bg-white shadow text-gray-700 hover:text-red-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            @endif
            
            <!-- Nút xem thêm desktop -->
            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center px-8 py-3 bg-red-700 text-white font-medium rounded-full hover:bg-red-800 transition-colors">
                    <span>Xem tất cả sản phẩm</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo Swiper cho mobile (5+ sản phẩm)
        if (document.querySelector('.products-swiper')) {
            const productsSwiper = new Swiper('.products-swiper', {
                slidesPerView: 1.5,
                spaceBetween: 10,
                centeredSlides: false,
                grabCursor: true,
                pagination: {
                    el: '.products-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: '.products-next-mobile',
                    prevEl: '.products-prev-mobile',
                },
                breakpoints: {
                    360: {
                        slidesPerView: 1.6,
                    },
                    480: {
                        slidesPerView: 2.2,
                    },
                    640: {
                        slidesPerView: 3,
                    }
                }
            });
        }
        
        // Khởi tạo Swiper cho desktop (9+ sản phẩm)
        if (document.querySelector('.desktop-products-swiper')) {
            const desktopProductsSwiper = new Swiper('.desktop-products-swiper', {
                slidesPerView: 3,
                spaceBetween: 24,
                grabCursor: true,
                pagination: {
                    el: '.desktop-products-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: '.products-next-desktop',
                    prevEl: '.products-prev-desktop',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 24
                    },
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 24
                    }
                }
            });
        }
    });
</script>
@endpush
@endif