@extends('layouts.error')
@section('title', 'Phiên làm việc hết hạn - 419')
@section('description', 'Phiên làm việc của bạn đã hết hạn. Vui lòng tải lại trang và thử lại.')

@section('content')
<div class="min-h-screen bg-white flex items-center justify-center p-4">
    <div class="max-w-lg text-center">
        <h1 class="text-9xl font-bold text-yellow-600 mb-4 font-montserrat">419</h1>
        <h2 class="text-3xl font-bold text-gray-900 mb-4 font-montserrat">Phiên làm việc hết hạn</h2>
        <p class="text-lg text-gray-600 mb-8">Phiên làm việc của bạn đã hết hạn vì lý do bảo mật. Vui lòng tải lại trang và thử lại.</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
            <button onclick="location.reload()" class="px-6 py-3 bg-yellow-600 text-white font-medium rounded-lg hover:bg-yellow-700 transition-colors">Tải lại trang</button>
            <a href="/" class="px-6 py-3 bg-white text-yellow-600 font-medium rounded-lg border border-yellow-600 hover:bg-yellow-50 transition-colors">Về trang chủ</a>
        </div>

        <div class="border-t border-gray-200 pt-8">
            <p class="text-gray-600 mb-4">Hoặc bạn có thể thử:</p>
            <div class="flex justify-center gap-4">
                <a href="/san-pham" class="text-yellow-600 hover:text-yellow-700 underline">Sản phẩm</a>
                <a href="/khoa-hoc" class="text-yellow-600 hover:text-yellow-700 underline">Khóa học</a>
                <a href="/tin-tuc" class="text-yellow-600 hover:text-yellow-700 underline">Tin tức</a>
            </div>
        </div>
    </div>
</div>
@endsection
