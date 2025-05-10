@php
    use App\Models\Post;
    use Carbon\Carbon;
    $latestPosts = Post::where('status', 1)
                    ->orderBy('created_at', 'desc')
                    ->take(6)
                    ->get();
    $postsCount = $latestPosts->count();
    
    // Lấy bài viết nổi bật nhất (bài mới nhất)
    $featuredPost = $latestPosts->first();
    // Lấy các bài viết còn lại
    $remainingPosts = $latestPosts->slice(1);
@endphp

<section class="py-16 bg-white relative" id="blog">
    <!-- Mô hình hình học tối giản làm nền -->
    <div class="absolute inset-0 overflow-hidden opacity-5 pointer-events-none">
        <div class="absolute -right-20 top-10 w-64 h-64 rounded-full border-8 border-red-200"></div>
        <div class="absolute -left-20 top-1/3 w-40 h-40 rounded-full border-8 border-red-100"></div>
        <div class="absolute right-1/4 bottom-10 w-80 h-80 rounded-full border-8 border-red-100"></div>
    </div>
    
    <div class="container mx-auto px-4 relative">
        <!-- Tiêu đề sáng tạo với gạch chéo -->
        <div class="text-center mb-12 relative">
            <div class="inline-block relative">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Tin tức & Sự kiện</h2>
                <div class="w-full h-1 bg-gradient-to-r from-red-600 via-red-500 to-red-600 absolute -bottom-3 left-0"></div>
                <div class="w-3 h-3 bg-red-600 absolute -bottom-4 left-1/2 transform -translate-x-1/2 rotate-45"></div>
            </div>
            <p class="text-gray-600 max-w-2xl mx-auto mt-6">Cập nhật những tin tức nổi bật và sự kiện mới nhất từ Vũ Phúc Baking</p>
        </div>

        <!-- Desktop View với Featured Post + Grid layout -->
        <div class="hidden md:block">
            <!-- Featured Post Section - Bài viết nổi bật -->
            @if($featuredPost)
            <div class="mb-12 group">
                <div class="grid md:grid-cols-5 gap-6 items-center">
                    <div class="md:col-span-3 relative overflow-hidden rounded-lg shadow-lg">
                        @if($featuredPost->thumbnail)
                        <div class="relative h-80 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-600/70 to-transparent z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <img 
                                src="{{ asset('storage/' . $featuredPost->thumbnail) }}" 
                                alt="{{ $featuredPost->title }}" 
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105"
                            >
                            <div class="absolute top-4 left-4 z-20">
                                <span class="bg-red-600 text-white text-xs px-3 py-1.5 rounded-full font-medium tracking-wide">
                                    Tin mới nhất
                                </span>
                            </div>
                        </div>
                        @else
                        <div class="bg-gradient-to-r from-red-500 to-red-700 h-80 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="md:col-span-2 p-3 md:p-6">
                        <div class="flex items-center mb-3">
                            <span class="inline-flex items-center text-xs bg-red-50 text-red-600 py-1 px-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ Carbon::parse($featuredPost->created_at)->translatedFormat('d/m/Y') }}
                            </span>
                            @if($featuredPost->category)
                                <span class="mx-2 text-gray-300">•</span>
                                <span class="inline-flex items-center text-xs bg-red-50 text-red-600 py-1 px-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    {{ $featuredPost->category->name }}
                                </span>
                            @endif
                        </div>
                        <a href="#" class="block group">
                            <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-red-600 transition-colors line-clamp-2">{{ $featuredPost->title }}</h3>
                        </a>
                        <p class="text-gray-600 mb-6 line-clamp-3">
                            {{ Str::limit(strip_tags($featuredPost->content), 180) }}
                        </p>
                        <a href="#" class="inline-flex items-center text-red-600 hover:text-red-700 font-medium border-b-2 border-red-600/30 hover:border-red-600 pb-0.5 transition-colors group">
                            <span>Đọc chi tiết</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1.5 transform transition-transform group-hover:translate-x-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Content Grid / Swiper -->
            @if($remainingPosts->count() > 0)
                @if($remainingPosts->count() <= 3)
                    <!-- Grid layout cho 1-3 bài viết còn lại -->
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach($remainingPosts as $post)
                            <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow group hover:translate-y-[-4px] duration-300">
                                <a href="#" class="block">
                                    <div class="h-48 overflow-hidden relative">
                                        @if($post->thumbnail)
                                            <img 
                                                src="{{ asset('storage/' . $post->thumbnail) }}" 
                                                alt="{{ $post->title }}" 
                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                            >
                                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        @else
                                            <div class="w-full h-full bg-gradient-to-r from-red-100 to-red-50 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="p-5 border-t border-gray-50">
                                    <div class="flex items-center mb-2 text-xs">
                                        <span class="text-gray-500">{{ Carbon::parse($post->created_at)->translatedFormat('d/m/Y') }}</span>
                                        @if($post->category)
                                            <span class="mx-2 text-gray-300">•</span>
                                            <span class="text-red-600">{{ $post->category->name }}</span>
                                        @endif
                                    </div>
                                    <a href="#">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-red-600 transition-colors line-clamp-2">{{ $post->title }}</h3>
                                    </a>
                                    <p class="text-gray-600 mb-4 line-clamp-2">
                                        {{ Str::limit(strip_tags($post->content), 100) }}
                                    </p>
                                    <div class="flex justify-between items-center pt-2">
                                        <a href="#" class="inline-flex items-center text-red-600 hover:text-red-700 font-medium text-sm group">
                                            <span>Đọc tiếp</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Swiper cho 4+ bài viết trên desktop -->
                    <div class="blog-desktop-carousel">
                        <div class="swiper-container blog-desktop-swiper">
                            <div class="swiper-wrapper">
                                @foreach($remainingPosts as $post)
                                    <div class="swiper-slide">
                                        <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow h-full mx-2 group">
                                            <a href="#" class="block">
                                                <div class="h-48 overflow-hidden relative">
                                                    @if($post->thumbnail)
                                                        <img 
                                                            src="{{ asset('storage/' . $post->thumbnail) }}" 
                                                            alt="{{ $post->title }}" 
                                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                                        >
                                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                    @else
                                                        <div class="w-full h-full bg-gradient-to-r from-red-100 to-red-50 flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                            </a>
                                            <div class="p-5 border-t border-gray-50">
                                                <div class="flex items-center mb-2 text-xs">
                                                    <span class="text-gray-500">{{ Carbon::parse($post->created_at)->translatedFormat('d/m/Y') }}</span>
                                                    @if($post->category)
                                                        <span class="mx-2 text-gray-300">•</span>
                                                        <span class="text-red-600">{{ $post->category->name }}</span>
                                                    @endif
                                                </div>
                                                <a href="#">
                                                    <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-red-600 transition-colors line-clamp-2">{{ $post->title }}</h3>
                                                </a>
                                                <p class="text-gray-600 mb-4 line-clamp-2">
                                                    {{ Str::limit(strip_tags($post->content), 100) }}
                                                </p>
                                                <div class="flex justify-between items-center pt-2">
                                                    <a href="#" class="inline-flex items-center text-red-600 hover:text-red-700 font-medium text-sm group">
                                                        <span>Đọc tiếp</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Navigation buttons -->
                            <div class="swiper-button-next blog-desktop-next"></div>
                            <div class="swiper-button-prev blog-desktop-prev"></div>
                            
                            <!-- Pagination -->
                            <div class="swiper-pagination blog-desktop-pagination mt-6"></div>
                        </div>
                    </div>
                @endif
            @endif
        </div>

        <!-- Mobile View - Thiết kế thẻ bài viết độc đáo -->
        <div class="md:hidden">
            <div class="overflow-hidden">
                <!-- Featured post trên mobile -->
                @if($featuredPost)
                <div class="mb-6 bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100">
                    <div class="relative">
                        @if($featuredPost->thumbnail)
                            <div class="h-52 overflow-hidden">
                                <img 
                                    src="{{ asset('storage/' . $featuredPost->thumbnail) }}" 
                                    alt="{{ $featuredPost->title }}" 
                                    class="w-full h-full object-cover"
                                >
                                <div class="absolute top-0 right-0 bg-red-600 text-white text-xs px-3 py-1 rounded-bl-lg font-medium">
                                    Nổi bật
                                </div>
                            </div>
                        @else
                            <div class="h-52 bg-gradient-to-r from-red-500 to-red-700 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex flex-wrap items-center mb-2 text-xs gap-2">
                            <span class="inline-flex items-center bg-red-50 text-red-600 py-1 px-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ Carbon::parse($featuredPost->created_at)->translatedFormat('d/m/Y') }}
                            </span>
                            @if($featuredPost->category)
                                <span class="inline-flex items-center bg-red-50 text-red-600 py-1 px-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    {{ $featuredPost->category->name }}
                                </span>
                            @endif
                        </div>
                        <a href="#">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $featuredPost->title }}</h3>
                        </a>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-3">
                            {{ Str::limit(strip_tags($featuredPost->content), 120) }}
                        </p>
                        <a href="#" class="flex justify-between items-center pt-2 text-red-600 border-t border-gray-100">
                            <span class="font-medium text-sm">Đọc chi tiết</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endif

                <!-- Remaining posts trong swiper -->
                <div class="blog-mobile-carousel">
                    <div class="swiper-container blog-mobile-swiper">
                        <div class="swiper-wrapper">
                            @foreach($remainingPosts as $post)
                                <div class="swiper-slide">
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm h-full mx-1.5 border border-gray-100">
                                        <a href="#" class="block">
                                            <div class="h-36 overflow-hidden">
                                                @if($post->thumbnail)
                                                    <img 
                                                        src="{{ asset('storage/' . $post->thumbnail) }}" 
                                                        alt="{{ $post->title }}" 
                                                        class="w-full h-full object-cover"
                                                    >
                                                @else
                                                    <div class="w-full h-full bg-red-50 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                        <div class="p-3">
                                            <div class="mb-1.5">
                                                <div class="flex flex-wrap items-center text-xs gap-2">
                                                    <span class="text-gray-500">{{ Carbon::parse($post->created_at)->translatedFormat('d/m/Y') }}</span>
                                                    @if($post->category)
                                                        <span class="text-red-600">{{ $post->category->name }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="#">
                                                <h3 class="text-base font-medium text-gray-900 mb-1.5 line-clamp-2 leading-snug">{{ $post->title }}</h3>
                                            </a>
                                            <p class="text-xs text-gray-600 mb-3 line-clamp-2">
                                                {{ Str::limit(strip_tags($post->content), 70) }}
                                            </p>
                                            <a href="#" class="inline-flex items-center text-xs text-red-600 font-medium">
                                                <span>Đọc tiếp</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination cho mobile -->
                        <div class="swiper-pagination blog-mobile-pagination mt-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA nút xem tất cả bài viết -->
        @if($postsCount > 0)
            <div class="text-center mt-10">
                <a href="#" class="inline-block px-6 md:px-8 py-3 md:py-3.5 bg-white text-red-600 font-medium rounded-full shadow-sm hover:shadow-md border border-red-600 hover:bg-red-600 hover:text-white transition-all duration-300">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        Xem tất cả bài viết
                    </span>
                </a>
            </div>
        @endif
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<style>
    /* Blog swiper styles */
    .blog-desktop-carousel,
    .blog-mobile-carousel {
        position: relative;
        padding: 0 0.5rem;
    }

    .blog-desktop-swiper .swiper-button-next,
    .blog-desktop-swiper .swiper-button-prev {
        color: white;
        --swiper-navigation-size: 20px;
        background: #dc2626;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
        opacity: 0;
        transition: all 0.3s;
    }
    
    .blog-desktop-carousel:hover .swiper-button-next,
    .blog-desktop-carousel:hover .swiper-button-prev {
        opacity: 0.9;
    }

    .blog-desktop-swiper .swiper-button-next:after,
    .blog-desktop-swiper .swiper-button-prev:after {
        font-size: 14px;
        font-weight: bold;
    }
    
    .blog-desktop-swiper .swiper-button-next:hover,
    .blog-desktop-swiper .swiper-button-prev:hover {
        background: #b91c1c;
        transform: scale(1.1);
    }

    .blog-desktop-swiper .swiper-pagination,
    .blog-mobile-swiper .swiper-pagination {
        position: relative;
        bottom: 0;
        margin-top: 20px;
    }

    .blog-desktop-swiper .swiper-pagination-bullet,
    .blog-mobile-swiper .swiper-pagination-bullet {
        width: 8px;
        height: 8px;
        transition: all 0.3s;
    }

    .blog-desktop-swiper .swiper-pagination-bullet-active,
    .blog-mobile-swiper .swiper-pagination-bullet-active {
        background: #dc2626;
        width: 20px;
        border-radius: 4px;
    }

    /* Mobile swiper specific */
    .blog-mobile-swiper {
        padding-bottom: 40px;
    }
    
    /* Line clamp utilities */
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .line-clamp-3 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
    
    /* Hover effects */
    @keyframes pulseRed {
        0% {
            box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.3);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(220, 38, 38, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(220, 38, 38, 0);
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Swiper cho desktop (4+ bài viết)
        if (document.querySelector('.blog-desktop-swiper')) {
            const blogDesktopSwiper = new Swiper('.blog-desktop-swiper', {
                slidesPerView: 3,
                spaceBetween: 16,
                grabCursor: true,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.blog-desktop-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.blog-desktop-next',
                    prevEl: '.blog-desktop-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 16,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 24,
                    }
                }
            });
        }

        // Swiper cho mobile
        if (document.querySelector('.blog-mobile-swiper')) {
            const blogMobileSwiper = new Swiper('.blog-mobile-swiper', {
                slidesPerView: 1.2,
                spaceBetween: 12,
                centeredSlides: false,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.blog-mobile-pagination',
                    clickable: true,
                },
                breakpoints: {
                    360: {
                        slidesPerView: 1.3,
                        spaceBetween: 12,
                    },
                    480: {
                        slidesPerView: 1.8,
                        spaceBetween: 16,
                    },
                    640: {
                        slidesPerView: 2.2,
                        spaceBetween: 16,
                    }
                }
            });
        }
    });
</script>
@endpush