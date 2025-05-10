@php
    $settings = \App\Models\Setting::first();
    $phone = $settings->phone ?? '1900636340';
    $zalo = $settings->zalo_url ?? 'https://zalo.me/';
    $messenger = $settings->facebook_url ?? 'https://m.me/';
@endphp

<div class="fixed bottom-6 right-6 z-40">
    <div class="flex flex-col-reverse items-end space-y-3 space-y-reverse">
        <!-- Nút liên hệ nhanh -->
        <button class="bg-red-700 text-white rounded-full w-14 h-14 shadow-lg flex items-center justify-center hover:bg-red-800 focus:outline-none transition-all" id="speedial-toggle" aria-label="Liên hệ nhanh">
            <span class="sr-only">Liên hệ</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
        
        <!-- Menu tùy chọn liên hệ -->
        <div class="hidden flex-col items-end space-y-3 mb-2" id="speedial-menu">
            <!-- Liên hệ qua Zalo -->
            <a href="{{ $zalo }}" target="_blank" class="flex items-center bg-white rounded-lg py-2 px-5 shadow-lg transition-all hover:shadow-xl hover:translate-x-[-2px] border border-red-100 group">
                <span class="font-medium text-red-700 group-hover:text-red-800 transition-colors">Zalo</span>
            </a>
            
            <!-- Liên hệ qua Messenger -->
            <a href="{{ $messenger }}" target="_blank" class="flex items-center bg-white rounded-lg py-2 px-5 shadow-lg transition-all hover:shadow-xl hover:translate-x-[-2px] border border-red-100 group">
                <span class="font-medium text-red-700 group-hover:text-red-800 transition-colors">Messenger</span>
            </a>
            
            <!-- Gọi điện -->
            <a href="tel:{{ $phone }}" class="flex items-center bg-white rounded-lg py-2 px-5 shadow-lg transition-all hover:shadow-xl hover:translate-x-[-2px] border border-red-100 group">
                <span class="font-medium text-red-700 group-hover:text-red-800 transition-colors">Gọi ngay</span>
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const speedialToggle = document.getElementById('speedial-toggle');
        const speedialMenu = document.getElementById('speedial-menu');
        
        if (speedialToggle && speedialMenu) {
            speedialToggle.addEventListener('click', function() {
                speedialMenu.classList.toggle('hidden');
                // Thêm hiệu ứng xoay cho nút khi mở menu
                this.classList.toggle('rotate-45');
            });

            // Đóng menu khi click ra ngoài
            document.addEventListener('click', function(event) {
                if (!speedialToggle.contains(event.target) && !speedialMenu.contains(event.target) && !speedialMenu.classList.contains('hidden')) {
                    speedialMenu.classList.add('hidden');
                    speedialToggle.classList.remove('rotate-45');
                }
            });
        }
    });
</script>

<style>
    #speedial-toggle {
        transition: transform 0.3s ease;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
    }
    #speedial-toggle:hover {
        box-shadow: 0 6px 16px rgba(220, 38, 38, 0.3);
    }
    #speedial-toggle.rotate-45 {
        transform: rotate(45deg);
    }
    #speedial-menu a {
        animation: slideIn 0.3s ease forwards;
        opacity: 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(220, 38, 38, 0.1);
    }
    #speedial-menu a:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05), 0 1px 5px rgba(220, 38, 38, 0.15);
    }
    #speedial-menu a:nth-child(1) {
        animation-delay: 0.1s;
    }
    #speedial-menu a:nth-child(2) {
        animation-delay: 0.2s;
    }
    #speedial-menu a:nth-child(3) {
        animation-delay: 0.3s;
    }
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>