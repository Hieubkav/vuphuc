@extends('layouts.shop')

@section('content')
    {{-- Hero Banner --}}
    @include('components.storefront.hero-banner')

    <!-- About Us -->
    <section class="animate-on-scroll py-12 md:py-16 bg-white">
        @include('components.storefront.about-us')
    </section>

    <!-- Stats Counter -->
    <section class="animate-on-scroll py-12 md:py-16 bg-gray-50">
        @include('components.storefront.stats-counter')
    </section>

    <!-- Featured Products -->
    <section class="animate-on-scroll py-12 md:py-16 bg-gray-50">
        @include('components.storefront.featured-products')
    </section>

    <!-- Services -->
    <section class="animate-on-scroll py-12 md:py-16 bg-gray-50">
        @include('components.storefront.services')
    </section>

    <!-- Slogan -->
    <section class="animate-on-scroll py-6 md:py-8">
        @include('components.storefront.slogan')
    </section>

    <!-- Courses Overview -->
    <section class="animate-on-scroll py-12 md:py-16 bg-white">
        @include('components.storefront.courses-overview')
    </section>

    <!-- Partners -->
    <section class="animate-on-scroll py-12 md:py-16 bg-white">
        @include('components.storefront.partners')
    </section>

    <!-- Blog Posts -->
    <section class="animate-on-scroll py-12 md:py-16 bg-gray-50">
        @include('components.storefront.blog-posts')
    </section>


@endsection

@push('styles')
<style>
    /* Scroll animations */
    .animate-on-scroll { opacity: 0; transform: translateY(30px); transition: opacity 1.2s ease, transform 1.2s ease; }
    .animate-on-scroll.animate-visible { opacity: 1; transform: translateY(0); }

    /* Section dividers */
    section::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 150px; height: 1px; background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.1), transparent); }
    section:last-of-type::after { display: none; }

    /* Custom scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f8f8f8; }
    ::-webkit-scrollbar-thumb { background: linear-gradient(to bottom, #c53030, #9b2c2c); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: linear-gradient(to bottom, #b91c1c, #7f1d1d); }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-visible');
                // Staggered animation for children
                const children = entry.target.querySelectorAll('.stagger-item');
                children.forEach((child, index) => {
                    setTimeout(() => child.classList.add('animate-visible'), 150 * index);
                });
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.animate-on-scroll').forEach(section => observer.observe(section));

    // Parallax effect
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset;
        document.querySelectorAll('.parallax-bg').forEach(element => {
            const speed = element.dataset.speed || 0.5;
            element.style.transform = `translateY(${scrollTop * speed}px)`;
        });
    });
});
</script>
@endpush
