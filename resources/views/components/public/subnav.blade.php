@php
    $settings = \App\Models\Setting::first();
@endphp

<div class="bg-red-700 text-white py-1 md:py-1.5">
    <div class="container mx-auto px-4">
        <!-- MOBILE VERSION - Hiển thị chỉ trên thiết bị di động (dưới md) -->
        <div class="md:hidden flex justify-between items-center">
            <!-- Số điện thoại - hiển thị trên mobile -->
            @if($settings && $settings->phone)
                <a href="tel:{{ $settings->phone }}" class="flex items-center gap-1.5 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>{{ $settings->phone }}</span>
                </a>
            @endif
            
            <!-- Social links - hiển thị trên mobile -->
            <div class="flex items-center gap-3">
                @if($settings && $settings->facebook_url)
                    <a href="{{ $settings->facebook_url }}" target="_blank" class="hover:text-red-200" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                        </svg>
                    </a>
                @endif
                @if($settings && $settings->youtube_url)
                    <a href="{{ $settings->youtube_url }}" target="_blank" class="hover:text-red-200" aria-label="Youtube">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                        </svg>
                    </a>
                @endif
                @if($settings && $settings->zalo_url)
                    <a href="{{ $settings->zalo_url }}" target="_blank" class="hover:text-red-200" aria-label="Zalo">
                        <span class="flex items-center justify-center text-xs font-bold w-3.5 h-3.5 bg-white text-blue-600 rounded-sm">Z</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- DESKTOP VERSION - Hiển thị chỉ từ md trở lên -->
        <div class="hidden md:flex justify-between items-center text-sm">
            <div class="flex items-center gap-6">
                @if($settings && $settings->phone)
                    <a href="tel:{{ $settings->phone }}" class="flex items-center gap-2 hover:text-red-200 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>{{ $settings->phone }}</span>
                    </a>
                @endif
                @if($settings && $settings->email)
                    <a href="mailto:{{ $settings->email }}" class="flex items-center gap-2 hover:text-red-200 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $settings->email }}</span>
                    </a>
                @endif
            </div>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-red-200 transition-colors duration-300">Giới thiệu</a>
                <a href="#" class="hover:text-red-200 transition-colors duration-300">Liên hệ</a>
                <div class="flex items-center gap-4">
                    @if($settings && $settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" target="_blank" class="hover:text-red-200 transition-colors duration-300" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                            </svg>
                        </a>
                    @endif
                    @if($settings && $settings->youtube_url)
                        <a href="{{ $settings->youtube_url }}" target="_blank" class="hover:text-red-200 transition-colors duration-300" aria-label="Youtube">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                            </svg>
                        </a>
                    @endif
                    @if($settings && $settings->zalo_url)
                        <a href="{{ $settings->zalo_url }}" target="_blank" class="hover:text-red-200 transition-colors duration-300" aria-label="Zalo">
                            <span class="flex items-center justify-center text-xs font-bold w-4 h-4 bg-white text-blue-600 rounded-sm">Z</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>