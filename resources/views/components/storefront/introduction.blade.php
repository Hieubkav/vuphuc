<div class="container mx-auto px-4">
    <div class="flex flex-col lg:flex-row gap-12 items-center">
        <!-- Left side content -->
        <div class="lg:w-1/2 space-y-6">
            <div>
                <span class="inline-block py-1 px-3 text-xs font-semibold bg-red-100 text-red-800 rounded-full tracking-wider">VỀ CHÚNG TÔI</span>
                <h2 class="mt-4 text-3xl md:text-4xl lg:text-5xl font-bold leading-tight text-gray-900">Chào mừng đến với <span class="text-red-700 italic">Vuphuc Baking<sup>®</sup></span></h2>
            </div>

            <div class="prose prose-lg max-w-none text-gray-600">
                <p class="mb-4 leading-relaxed">Lấy người tiêu dùng làm trọng tâm cho mọi hoạt động, chúng tôi luôn tiên phong trong việc tạo ra xu hướng tiêu dùng trong ngành thực phẩm và luôn sáng tạo để phục vụ người tiêu dùng tạo ra những sản phẩm an toàn, chất lượng và hướng đến mục tiêu phát triển bền vững.</p>

                <p class="mb-4 leading-relaxed">Luôn tự đòi hỏi cao hơn ở chính mình, công ty chúng tôi đã và đang không ngừng nỗ lực đa dạng hóa sản phẩm, hướng đến phục vụ nhu cầu thiết yếu hàng ngày của người tiêu dùng.</p>

                <div class="mt-6 border-l-4 border-red-600 pl-6 italic">
                    <p class="text-xl font-medium text-gray-800">"Giá trị cốt lõi của chúng tôi là <span class="text-red-700 font-semibold">Vì sự phát triển của khách hàng</span>, do vậy chúng tôi không ngừng nỗ lực tìm kiếm những giải pháp về kỹ thuật, công nghệ và phương thức bán hàng để có thể hỗ trợ công việc kinh doanh của khách hàng một cách tốt nhất."</p>
                </div>
            </div>

            <div class="pt-4">
                <a href="#" class="inline-flex items-center px-6 py-3 bg-red-700 text-white font-medium rounded-lg hover:bg-red-800 transition-colors group">
                    <span>Tìm hiểu thêm về chúng tôi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Right side images -->
        <div class="lg:w-1/2 relative">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div class="relative overflow-hidden rounded-xl shadow-lg transform hover:scale-[1.02] transition-all duration-500">
                        <img src="{{ asset('images/bakery-1.jpg') }}" alt="Bánh ngọt cao cấp" class="w-full h-[240px] object-cover" onerror="this.src='https://images.unsplash.com/photo-1609950547346-a4f431435b2b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=700&q=80';">
                    </div>
                    <div class="relative overflow-hidden rounded-xl shadow-lg transform hover:scale-[1.02] transition-all duration-500">
                        <img src="{{ asset('images/bakery-2.jpg') }}" alt="Quy trình sản xuất" class="w-full h-[200px] object-cover" onerror="this.src='https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=700&q=80';">
                    </div>
                </div>
                <div class="mt-8 space-y-4">
                    <div class="relative overflow-hidden rounded-xl shadow-lg transform hover:scale-[1.02] transition-all duration-500">
                        <img src="{{ asset('images/bakery-3.jpg') }}" alt="Đào tạo chuyên nghiệp" class="w-full h-[200px] object-cover" onerror="this.src='https://images.unsplash.com/photo-1568254183919-78a4f43a2877?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=700&q=80';">
                    </div>
                    <div class="relative overflow-hidden rounded-xl shadow-lg transform hover:scale-[1.02] transition-all duration-500">
                        <img src="{{ asset('images/bakery-4.jpg') }}" alt="Đội ngũ chuyên gia" class="w-full h-[240px] object-cover" onerror="this.src='https://images.unsplash.com/photo-1556040220-4096d522378d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=700&q=80';">
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-red-100 rounded-full opacity-70 -z-10"></div>
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-red-100 rounded-full opacity-70 -z-10"></div>
        </div>
    </div>

    <!-- Animated Stats Counters -->
    <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="text-center p-6 rounded-lg bg-white shadow-lg hover:shadow-xl transition-shadow border-t-4 border-red-600 stagger-item">
           hơn <div class="text-4xl font-bold text-red-700 counter" data-target="10">0+</div>
            <p class="text-gray-600 mt-2">Năm kinh nghiệm</p>
        </div>
        <div class="text-center p-6 rounded-lg bg-white shadow-lg hover:shadow-xl transition-shadow border-t-4 border-red-600 stagger-item">
            <div class="text-4xl font-bold text-red-700 counter" data-target="5000">0</div>
            <p class="text-gray-600 mt-2">Khách hàng tin cậy</p>
        </div>
        <div class="text-center p-6 rounded-lg bg-white shadow-lg hover:shadow-xl transition-shadow border-t-4 border-red-600 stagger-item">
            <div class="text-4xl font-bold text-red-700 counter" data-target="300">0</div>
            <p class="text-gray-600 mt-2">Sản phẩm đa dạng</p>
        </div>
        <div class="text-center p-6 rounded-lg bg-white shadow-lg hover:shadow-xl transition-shadow border-t-4 border-red-600 stagger-item">
            <div class="text-4xl font-bold text-red-700 counter" data-target="19">0</div>
            <p class="text-gray-600 mt-2">Tỉnh thành phủ sóng</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Counter animation
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.counter');
                    counters.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-target'));
                        const duration = 2000; // Animation duration in ms
                        const increment = target / (duration / 16); // Update every 16ms for smooth animation

                        let current = 0;
                        const updateCounter = () => {
                            current += increment;
                            if (current < target) {
                                counter.textContent = Math.ceil(current);
                                requestAnimationFrame(updateCounter);
                            } else {
                                counter.textContent = target.toLocaleString();
                            }
                        };
                        updateCounter();
                    });
                    counterObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        const statsSection = document.querySelector('.mt-16');
        if (statsSection) {
            counterObserver.observe(statsSection);
        }
    });
</script>
@endpush
