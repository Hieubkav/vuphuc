@extends('layouts.error')
@section('title', 'Trang không tìm thấy - 404')
@section('description', 'Trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển.')

@section('content')
<div class="min-h-screen bg-white flex items-center justify-center p-4">
    <div class="max-w-lg text-center">
        <h1 class="text-9xl font-bold text-red-600 mb-4 font-montserrat">404</h1>
        <h2 class="text-3xl font-bold text-gray-900 mb-4 font-montserrat">Trang không tìm thấy</h2>
        <p class="text-lg text-gray-600 mb-8">Trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển.</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
            <a href="/" class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">Về trang chủ</a>
            <button onclick="history.back()" class="px-6 py-3 bg-white text-red-600 font-medium rounded-lg border border-red-600 hover:bg-red-50 transition-colors">Quay lại</button>
        </div>

        <div class="border-t border-gray-200 pt-8">
            <p class="text-gray-600 mb-4">Hoặc bạn có thể thử:</p>
            <div class="flex justify-center gap-4">
                <a href="/san-pham" class="text-red-600 hover:text-red-700 underline">Sản phẩm</a>
                <a href="/khoa-hoc" class="text-red-600 hover:text-red-700 underline">Khóa học</a>
                <a href="/tin-tuc" class="text-red-600 hover:text-red-700 underline">Tin tức</a>
            </div>
        </div>
    </div>
</div>
@endsection
