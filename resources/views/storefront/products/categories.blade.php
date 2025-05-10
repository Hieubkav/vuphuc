@extends('layouts.storefront')

@section('title', 'Tất cả danh mục sản phẩm - Vũ Phúc Baking')

@section('content')
<div class="bg-white py-8 md:py-12">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Danh mục sản phẩm</h1>
            <div class="flex items-center text-sm text-gray-500">
                <a href="{{ route('storeFront') }}" class="hover:text-red-700">Trang chủ</a>
                <span class="mx-2">/</span>
                <span>Danh mục sản phẩm</span>
            </div>
        </div>

        @if($categories->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 md:gap-6">
            @foreach($categories as $category)
                <a href="{{ route('products.category', $category->slug) }}" class="group">
                    <div class="bg-gray-50 rounded-lg shadow-sm p-6 transition-all duration-300 group-hover:bg-red-50 group-hover:shadow-md text-center h-full flex flex-col">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors group-hover:bg-red-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <h3 class="font-medium text-lg text-gray-900 group-hover:text-red-700 transition-colors">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500 mt-2 flex-grow">
                            @if($category->description)
                                {{ Str::limit($category->description, 80) }}
                            @else
                                Khám phá các sản phẩm {{ strtolower($category->name) }} chất lượng cao
                            @endif
                        </p>
                        <div class="mt-4 text-red-700 text-sm flex items-center justify-center group-hover:font-medium">
                            <span>Xem sản phẩm</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <p class="text-gray-500">Không có danh mục sản phẩm nào</p>
        </div>
        @endif
    </div>
</div>
@endsection