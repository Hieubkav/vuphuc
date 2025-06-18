@extends('layouts.shop')

@section('content')
    {{-- Sử dụng Dynamic StoreFront Component để hiển thị theo thứ tự cấu hình --}}
    @include('components.dynamic-storefront')


@endsection

@push('styles')
<style>
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
