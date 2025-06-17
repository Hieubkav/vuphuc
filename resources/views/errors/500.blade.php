@extends('layouts.error')
@section('title', 'Lỗi hệ thống - 500')
@section('description', 'Đã xảy ra lỗi hệ thống. Chúng tôi đang khắc phục sự cố này.')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 to-white flex items-center justify-center p-4">
    <div class="max-w-2xl text-center">
        <div class="relative mb-8">
            <h1 class="text-9xl font-bold text-red-100 animate-pulse">500</h1>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-32 h-32 bg-red-600 rounded-full flex items-center justify-center animate-pulse">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <h2 class="text-4xl font-bold text-gray-900 mb-4 font-montserrat">Lỗi hệ thống</h2>
        <p class="text-xl text-gray-600 mb-8">Đã xảy ra lỗi không mong muốn. Chúng tôi đang khắc phục sự cố này.</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
            <a href="/" class="px-8 py-4 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-all">Về trang chủ</a>
            <button onclick="location.reload()" class="px-8 py-4 bg-white text-red-600 font-semibold rounded-lg border-2 border-red-600 hover:bg-red-50 transition-all">Thử lại</button>
        </div>

        <div class="bg-white rounded-xl p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-3">Thông tin sự cố</h3>
            <div class="text-left space-y-2 text-gray-600">
                <p><strong>Thời gian:</strong> {{ now()->format('d/m/Y H:i:s') }}</p>
                <p><strong>Mã lỗi:</strong> 500 - Internal Server Error</p>
                <p><strong>Trạng thái:</strong> Đang khắc phục</p>
            </div>
        </div>

        @if(config('app.debug'))
        <div class="bg-gray-100 rounded-lg p-4 text-left">
            <h4 class="font-bold text-gray-900 mb-2">Chi tiết kỹ thuật:</h4>
            <div class="text-sm text-gray-700 space-y-1">
                <p><strong>URL:</strong> {{ request()->fullUrl() }}</p>
                <p><strong>Method:</strong> {{ request()->method() }}</p>
                <p><strong>IP:</strong> {{ request()->ip() }}</p>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
setTimeout(() => confirm('Trang sẽ được tải lại để thử kết nối. Bạn có muốn tiếp tục?') && location.reload(), 30000);
</script>
@endpush
@endsection
