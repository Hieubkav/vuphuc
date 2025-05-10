@extends('layouts.storefront')

@section('title', $category->name . ' - Vũ Phúc Baking')

@section('content')
<div class="bg-white py-8 md:py-12">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
            <div class="flex items-center text-sm text-gray-500">
                <a href="{{ route('storeFront') }}" class="hover:text-red-700">Trang chủ</a>
                <span class="mx-2">/</span>
                <a href="{{ route('products.categories') }}" class="hover:text-red-700">Danh mục</a>
                <span class="mx-2">/</span>
                <span>{{ $category->name }}</span>
            </div>
        </div>

        @if($category->description)
            <div class="mb-8 max-w-3xl">
                <div class="prose prose-red">
                    {!! $category->description !!}
                </div>
            </div>
        @endif

        @if($products->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($products as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="group">
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden h-full flex flex-col transition-all duration-300 group-hover:shadow-md">
                            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-100">
                                @php
                                    $image = $product->productImages->first();
                                @endphp
                                @if($image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-full object-center object-cover transform transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4 flex-grow flex flex-col">
                                <h3 class="text-sm md:text-base font-medium text-gray-900 group-hover:text-red-700 transition-colors">{{ $product->name }}</h3>
                                
                                <div class="mt-auto pt-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            @if($product->sale_price && $product->sale_price < $product->price)
                                                <p class="text-sm text-gray-500 line-through">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                                <p class="text-base md:text-lg font-semibold text-red-700">{{ number_format($product->sale_price, 0, ',', '.') }}đ</p>
                                            @else
                                                <p class="text-base md:text-lg font-semibold text-red-700">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center justify-center rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700">Chi tiết</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-gray-500">Không có sản phẩm nào trong danh mục này</p>
                <a href="{{ route('products.categories') }}" class="mt-4 inline-flex items-center text-red-700 hover:text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    <span>Quay lại danh mục sản phẩm</span>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection