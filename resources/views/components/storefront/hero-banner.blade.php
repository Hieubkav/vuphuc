@php
    use App\Models\Carousel;
    $carousels = Carousel::where('status', 1)->orderBy('order')->get();
@endphp

<section class="relative overflow-hidden">
    <!-- Carousel with parallax effect -->
    <div class="relative hero-carousel" x-data="{ 
        activeSlide: 0,
        slides: {{ $carousels->count() }},
        interval: null,
        init() {
            this.interval = setInterval(() => this.nextSlide(), 6000);
        },
        nextSlide() {
            this.activeSlide = (this.activeSlide + 1) % this.slides;
        },
        prevSlide() {
            this.activeSlide = (this.activeSlide + this.slides - 1) % this.slides;
        }
    }" x-init="init()">
        <!-- Mobile version (dưới md) -->
        <div class="md:hidden overflow-hidden relative h-[300px] sm:h-[400px]">
            @forelse($carousels as $index => $carousel)
                <div 
                    class="absolute inset-0 transition-all duration-1000 ease-in-out transform hero-slide"
                    x-bind:class="{ 
                        'opacity-100 scale-100': activeSlide === {{ $index }}, 
                        'opacity-0 scale-110': activeSlide !== {{ $index }} 
                    }">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-black/40 z-10"></div>
                    <img 
                        src="{{ asset('storage/' . $carousel->image) }}" 
                        alt="{{ $carousel->title ?? 'Banner Vũ Phúc Baking ' . ($index + 1) }}" 
                        class="object-cover object-center w-full h-full transform scale-105 transition-all duration-7000 ease-in-out"
                        x-bind:class="{ 'scale-100': activeSlide === {{ $index }}, 'scale-105': activeSlide !== {{ $index }} }"
                    >
                    @if($carousel->title || $carousel->description)
                    <div class="absolute inset-0 z-20 flex flex-col justify-end p-6 sm:p-8">
                        <div 
                            class="transform transition-all duration-1000 delay-200"
                            x-bind:class="{ 'opacity-100 translate-y-0': activeSlide === {{ $index }}, 'opacity-0 translate-y-4': activeSlide !== {{ $index }} }"
                        >
                            @if($carousel->title)
                                <h2 class="text-white text-xl sm:text-2xl font-bold mb-2 text-shadow-sm">{{ $carousel->title }}</h2>
                            @endif
                            @if($carousel->description)
                                <p class="text-white text-sm sm:text-base mb-3 max-w-md text-shadow-sm">{{ $carousel->description }}</p>
                            @endif
                            @if($carousel->button_text && $carousel->button_link)
                                <a href="{{ $carousel->button_link }}" class="inline-flex items-center bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg transition transform hover:-translate-y-0.5">
                                    <span>{{ $carousel->button_text }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            @empty
                <div class="relative h-[300px] sm:h-[400px] bg-gray-100 flex items-center justify-center">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/30 z-10"></div>
                    <img 
                        src="{{ asset('images/default-banner.jpg') }}" 
                        alt="Banner Vũ Phúc Baking" 
                        class="object-cover object-center w-full h-full"
                        onerror="this.src='https://via.placeholder.com/800x400/f87171/ffffff?text=Vũ+Phúc+Baking'"
                    >
                    <div class="absolute inset-0 z-20 flex flex-col justify-end p-6 sm:p-8">
                        <h2 class="text-white text-xl sm:text-2xl font-bold mb-2 text-shadow-sm">Nguyên Liệu & Dụng Cụ Làm Bánh</h2>
                        <p class="text-white text-sm sm:text-base mb-3 max-w-md text-shadow-sm">Chất lượng cao - Đa dạng - Giá tốt</p>
                        <a href="{{ route('products.categories') }}" class="inline-flex items-center bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg transition transform hover:-translate-y-0.5">
                            <span>Khám phá ngay</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Desktop version (md trở lên) -->
        <div class="hidden md:block overflow-hidden relative h-[500px] lg:h-[650px]">
            @forelse($carousels as $index => $carousel)
                <div 
                    class="absolute inset-0 transition-all duration-1000 ease-in-out transform hero-slide"
                    x-bind:class="{ 
                        'opacity-100 scale-100': activeSlide === {{ $index }}, 
                        'opacity-0 scale-110': activeSlide !== {{ $index }} 
                    }">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/20 to-transparent z-10"></div>
                    <img 
                        src="{{ asset('storage/' . $carousel->image) }}" 
                        alt="{{ $carousel->title ?? 'Banner Vũ Phúc Baking ' . ($index + 1) }}" 
                        class="object-cover object-center w-full h-full transform scale-105 transition-all duration-7000 ease-in-out"
                        x-bind:class="{ 'scale-100': activeSlide === {{ $index }}, 'scale-105': activeSlide !== {{ $index }} }"
                    >
                    @if($carousel->title || $carousel->description)
                    <div class="absolute inset-0 z-20 flex items-center">
                        <div class="container mx-auto px-4 lg:px-6">
                            <div 
                                class="max-w-xl transform transition-all duration-1000 delay-300"
                                x-bind:class="{ 'opacity-100 translate-y-0': activeSlide === {{ $index }}, 'opacity-0 translate-y-4': activeSlide !== {{ $index }} }"
                            >
                                @if($carousel->title)
                                    <h2 class="text-white text-3xl lg:text-5xl font-bold mb-4 text-shadow">{{ $carousel->title }}</h2>
                                @endif
                                @if($carousel->description)
                                    <p class="text-white text-base lg:text-lg mb-6 max-w-lg text-shadow">{{ $carousel->description }}</p>
                                @endif
                                @if($carousel->button_text && $carousel->button_link)
                                    <a href="{{ $carousel->button_link }}" class="inline-flex items-center bg-red-700 hover:bg-red-800 text-white px-5 py-3 rounded-lg transition transform hover:-translate-y-0.5">
                                        <span class="font-medium">{{ $carousel->button_text }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            @empty
                <div class="relative h-[500px] lg:h-[650px] bg-gray-100 flex items-center justify-center">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/20 to-transparent z-10"></div>
                    <img 
                        src="{{ asset('images/default-banner-desktop.jpg') }}" 
                        alt="Banner Vũ Phúc Baking" 
                        class="object-cover object-center w-full h-full"
                        onerror="this.src='https://via.placeholder.com/1920x600/f87171/ffffff?text=Vũ+Phúc+Baking'"
                    >
                    <div class="absolute inset-0 z-20 flex items-center">
                        <div class="container mx-auto px-4 lg:px-6">
                            <div class="max-w-xl">
                                <h2 class="text-white text-3xl lg:text-5xl font-bold mb-4 text-shadow">Nguyên Liệu & Dụng Cụ Làm Bánh</h2>
                                <p class="text-white text-base lg:text-lg mb-6 max-w-lg text-shadow">Vũ Phúc Baking - Nhà phân phối độc quyền Rich Products Vietnam tại ĐBSCL</p>
                                <a href="{{ route('products.categories') }}" class="inline-flex items-center bg-red-700 hover:bg-red-800 text-white px-5 py-3 rounded-lg transition transform hover:-translate-y-0.5">
                                    <span class="font-medium">Khám phá ngay</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Controls - Hiển thị trên cả mobile và desktop -->
        @if($carousels->count() > 1)
        <div class="absolute inset-x-0 top-1/2 transform -translate-y-1/2 flex items-center justify-between px-4 md:px-6">
            <button 
                @click="prevSlide(); clearInterval(interval); interval = setInterval(() => nextSlide(), 6000)" 
                class="p-1.5 sm:p-2 rounded-full bg-white/30 backdrop-blur-sm text-white hover:bg-white hover:text-gray-900 focus:outline-none transition transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button 
                @click="nextSlide(); clearInterval(interval); interval = setInterval(() => nextSlide(), 6000)" 
                class="p-1.5 sm:p-2 rounded-full bg-white/30 backdrop-blur-sm text-white hover:bg-white hover:text-gray-900 focus:outline-none transition transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Indicators -->
        <div class="absolute bottom-4 sm:bottom-5 left-0 right-0 z-30">
            <div class="flex items-center justify-center gap-1.5 sm:gap-2">
                @foreach($carousels as $index => $carousel)
                    <button 
                        @click="activeSlide = {{ $index }}; clearInterval(interval); interval = setInterval(() => nextSlide(), 6000)"
                        class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full transition-all duration-300 focus:outline-none relative overflow-hidden"
                        x-bind:class="{ 'bg-white w-6 sm:w-8': activeSlide === {{ $index }}, 'bg-white/50': activeSlide !== {{ $index }} }"
                    >
                        <span 
                            class="absolute left-0 top-0 h-full bg-white/80 transition-all duration-6000"
                            x-bind:class="{ 'w-full': activeSlide === {{ $index }}, 'w-0': activeSlide !== {{ $index }} }"
                            x-bind:style="activeSlide === {{ $index }} ? 'animation: progressBar 6s linear forwards;' : ''"
                        ></span>
                    </button>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<style>
    .text-shadow {
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .text-shadow-sm {
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }
    
    .hero-carousel {
        background-color: #f3f4f6;
    }
    
    .hero-slide {
        will-change: transform, opacity;
    }
    
    @keyframes progressBar {
        0% { width: 0; }
        100% { width: 100%; }
    }
    
    @media (min-width: 768px) {
        .hero-slide::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, transparent 50%, rgba(0,0,0,0.15) 100%);
            z-index: 5;
            pointer-events: none;
        }
    }
    
    @keyframes kenburns {
        0% { transform: scale(1); }
        100% { transform: scale(1.05); }
    }
    
    .duration-7000 {
        transition-duration: 7000ms;
    }
</style>