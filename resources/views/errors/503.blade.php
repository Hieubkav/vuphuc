@extends('layouts.error')
@section('title', 'Dịch vụ tạm ngưng - 503')
@section('description', 'Dịch vụ hiện đang bảo trì. Chúng tôi sẽ quay lại sớm nhất có thể.')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white flex items-center justify-center p-4">
    <div class="max-w-2xl text-center">
        <div class="relative mb-8">
            <h1 class="text-9xl font-bold text-blue-100 animate-pulse">503</h1>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-32 h-32 bg-blue-600 rounded-full flex items-center justify-center animate-spin">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <h2 class="text-4xl font-bold text-gray-900 mb-4 font-montserrat">Dịch vụ tạm ngưng</h2>
        <p class="text-xl text-gray-600 mb-8">Chúng tôi đang thực hiện bảo trì hệ thống để mang đến trải nghiệm tốt hơn.</p>

        <div class="bg-blue-50 rounded-xl p-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Đang bảo trì hệ thống</h3>
            <p class="text-gray-600">Chúng tôi đang nâng cấp hệ thống để phục vụ bạn tốt hơn. Vui lòng quay lại sau ít phút.</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
            <button onclick="location.reload()" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">Thử lại</button>
            <a href="/" class="px-6 py-3 bg-white text-blue-600 font-medium rounded-lg border border-blue-600 hover:bg-blue-50 transition-colors">Về trang chủ</a>
        </div>

        <p class="text-gray-600">Theo dõi cập nhật trạng thái tại trang chủ của chúng tôi</p>
    </div>
</div>

@push('scripts')
<script>
setTimeout(() => confirm('Hệ thống có thể đã sẵn sàng. Bạn có muốn thử lại?') && location.reload(), 60000);
</script>
@endpush
@endsection
