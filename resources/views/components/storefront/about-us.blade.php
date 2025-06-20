@php
    $aboutData = webDesignData('about-us');
    $services = webDesignContent('about-us', 'services', []);
@endphp

<div class="container mx-auto px-4">
    <div class="flex flex-col lg:flex-row gap-10 items-center">
        <!-- Left side content -->
        <div class="lg:w-1/2 space-y-5">
            <div>
                <span class="section-badge">{{ $aboutData?->subtitle ?? 'VỀ CHÚNG TÔI' }}</span>
                <h2 class="section-title mt-4">
                    {{ $aboutData?->title ?? 'Chào mừng đến với Vuphuc Baking®' }}
                </h2>
            </div>

            <div class="prose prose-lg max-w-none text-gray-600">
                <p class="mb-4 leading-relaxed">{{ webDesignContent('about-us', 'description', 'Lấy người tiêu dùng làm trọng tâm cho mọi hoạt động, chúng tôi luôn tiên phong trong việc tạo ra xu hướng tiêu dùng trong ngành thực phẩm và luôn sáng tạo để phục vụ người tiêu dùng tạo ra những sản phẩm an toàn, chất lượng và hướng đến mục tiêu phát triển bền vững.') }}</p>

                @if(webDesignContent('about-us', 'quote'))
                <div class="mt-6 border-l-4 border-red-600 pl-6 italic">
                    <p class="text-xl font-medium text-gray-800">"{{ webDesignContent('about-us', 'quote') }}"</p>
                </div>
                @endif
            </div>

            @if($aboutData && $aboutData->button_text && $aboutData->button_url)
            <div class="pt-4">
                <a href="{{ $aboutData->button_url }}" class="inline-flex items-center px-6 py-3 bg-red-700 text-white font-medium rounded-lg hover:bg-red-800 transition-colors group">
                    <span>{{ $aboutData->button_text }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
            @endif
        </div>

        <!-- Right side decorative elements -->
        <div class="lg:w-1/2 relative">
            <!-- Decorative bakery icons grid -->
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-6">
                    @if(isset($services[0]))
                    <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-red-50 to-red-100 p-8 shadow-lg transform hover:scale-[1.02] transition-all duration-500">
                        <div class="flex flex-col items-center text-center">
                            @if(!empty($services[0]['image']))
                                <div class="w-16 h-16 rounded-full overflow-hidden mb-4 border-4 border-red-600">
                                    <img src="{{ $services[0]['image'] }}" alt="{{ $services[0]['title'] }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                </div>
                            @endif
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $services[0]['title'] ?? 'Bánh Ngọt Cao Cấp' }}</h3>
                            <p class="text-sm text-gray-600">{{ $services[0]['desc'] ?? 'Sản phẩm chất lượng từ nguyên liệu tự nhiên' }}</p>
                        </div>
                    </div>
                    @endif
                    @if(isset($services[1]))
                    <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-red-50 to-red-100 p-8 shadow-lg transform hover:scale-[1.02] transition-all duration-500">
                        <div class="flex flex-col items-center text-center">
                            @if(!empty($services[1]['image']))
                                <div class="w-16 h-16 rounded-full overflow-hidden mb-4 border-4 border-red-600">
                                    <img src="{{ $services[1]['image'] }}" alt="{{ $services[1]['title'] }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm6 7a1 1 0 011 1v3a1 1 0 11-2 0v-3a1 1 0 011-1zm-3 3a1 1 0 100 2h.01a1 1 0 100-2H10zm-4 1a1 1 0 011-1h.01a1 1 0 110 2H7a1 1 0 01-1-1zm1-4a1 1 0 100 2h.01a1 1 0 100-2H7zm2 0a1 1 0 100 2h.01a1 1 0 100-2H9zm2 0a1 1 0 100 2h.01a1 1 0 100-2H11z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @endif
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $services[1]['title'] ?? 'Quy Trình Chuẩn' }}</h3>
                            <p class="text-sm text-gray-600">{{ $services[1]['desc'] ?? 'Kiểm soát chất lượng nghiêm ngặt' }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mt-8 space-y-6">
                    @if(isset($services[2]))
                    <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-red-50 to-red-100 p-8 shadow-lg transform hover:scale-[1.02] transition-all duration-500">
                        <div class="flex flex-col items-center text-center">
                            @if(!empty($services[2]['image']))
                                <div class="w-16 h-16 rounded-full overflow-hidden mb-4 border-4 border-red-600">
                                    <img src="{{ $services[2]['image'] }}" alt="{{ $services[2]['title'] }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                    </svg>
                                </div>
                            @endif
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $services[2]['title'] ?? 'Đào Tạo Chuyên Nghiệp' }}</h3>
                            <p class="text-sm text-gray-600">{{ $services[2]['desc'] ?? 'Hỗ trợ kỹ thuật và đào tạo' }}</p>
                        </div>
                    </div>
                    @endif
                    @if(isset($services[3]))
                    <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-red-50 to-red-100 p-8 shadow-lg transform hover:scale-[1.02] transition-all duration-500">
                        <div class="flex flex-col items-center text-center">
                            @if(!empty($services[3]['image']))
                                <div class="w-16 h-16 rounded-full overflow-hidden mb-4 border-4 border-red-600">
                                    <img src="{{ $services[3]['image'] }}" alt="{{ $services[3]['title'] }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            @endif
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $services[3]['title'] ?? 'Đội Ngũ Chuyên Gia' }}</h3>
                            <p class="text-sm text-gray-600">{{ $services[3]['desc'] ?? 'Kinh nghiệm nhiều năm trong ngành' }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Decorative background elements -->
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-red-100 rounded-full opacity-70 -z-10"></div>
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-red-100 rounded-full opacity-70 -z-10"></div>
        </div>
    </div>
</div>
