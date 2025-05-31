<div class="container mx-auto px-4">
    <!-- Animated Stats Counters -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="text-center p-6 rounded-lg bg-white shadow-lg hover:shadow-xl transition-shadow border-t-4 border-red-600 stagger-item">
            <div class="text-4xl font-bold text-red-700 counter" data-target="10">0</div>
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

        const statsSection = document.querySelector('.grid.grid-cols-2.md\\:grid-cols-4');
        if (statsSection) {
            counterObserver.observe(statsSection);
        }
    });
</script>
@endpush
