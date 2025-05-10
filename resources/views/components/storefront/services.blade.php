@php
    use App\Models\Service;
    $services = Service::where('status', 1)->orderBy('order')->get();
@endphp

<section class="py-16 md:py-20 bg-white" id="services">
    <div class="container mx-auto px-6 md:px-8 lg:px-16">
        <div class="text-center mb-12 md:mb-16">
            <span class="text-xs uppercase tracking-[0.25em] font-medium text-red-600 mb-2 inline-block">Chất lượng hàng đầu</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Dịch vụ của chúng tôi</h2>
            <div class="w-12 h-0.5 bg-red-600 mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4 lg:gap-5 max-w-6xl mx-auto">
            @foreach($services as $service)
                <div onclick="window.location.href='#service-{{ $service->id }}'" class="cursor-pointer group bg-white overflow-hidden border-[0.5px] border-gray-100 hover:border-red-50 hover:shadow-[0_5px_20px_rgba(0,0,0,0.06)] transition-all duration-500 flex flex-col h-full transform hover:-translate-y-1">
                    <div class="relative overflow-hidden rounded-sm">
                        @if($service->image)
                            <div class="aspect-[5/3] overflow-hidden">
                                <img src="{{ asset('storage/' . $service->image) }}" 
                                    alt="{{ $service->name }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end justify-start p-3">
                                    <span class="inline-flex items-center text-xs text-white tracking-wider">
                                        <span class="mr-1.5 w-5 h-[1px] bg-white"></span>
                                        XEM CHI TIẾT
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="aspect-[5/3] bg-gray-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-3.5 md:p-4 flex items-center justify-between">
                        <h3 class="text-base md:text-lg font-medium text-gray-900 group-hover:text-red-600 transition-colors">{{ $service->name }}</h3>
                        <div class="w-7 h-7 rounded-full flex items-center justify-center border border-gray-200 group-hover:border-red-600 group-hover:bg-red-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-400 group-hover:text-red-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if(count($services) > 0)
        <div class="mt-10 md:mt-14 text-center">
            <a href="#" class="group inline-flex items-center justify-center">
                <span class="text-xs tracking-wider uppercase font-medium text-gray-500 group-hover:text-red-600 transition-colors mr-2">Xem tất cả</span>
                <span class="w-8 h-[1px] bg-red-600 transition-all group-hover:w-12"></span>
                <span class="w-5 h-5 rounded-full border border-gray-200 flex items-center justify-center ml-2 group-hover:border-red-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5 text-gray-400 group-hover:text-red-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </a>
        </div>
        @endif
    </div>
</section>