@extends('layouts.shop')

@section('content')
<div class="min-h-screen bg-gray-50 py-4 px-3">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center gap-3 mb-4">
                <a href="{{ route('customer.orders.index') }}" 
                   class="w-8 h-8 bg-white rounded-lg border flex items-center justify-center hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Chi tiết đơn hàng</h1>
                    <p class="text-gray-600">#{{ $order->order_number }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Info -->
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Thông tin đơn hàng</h2>
                    
                    @php
                        $statusConfig = App\Http\Controllers\CustomerOrderController::getStatusConfig($order->status);
                        $paymentConfig = App\Http\Controllers\CustomerOrderController::getPaymentStatusConfig($order->payment_status ?? 'pending');
                    @endphp
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Mã đơn hàng</label>
                            <p class="text-gray-900 font-mono">#{{ $order->order_number }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Ngày đặt</label>
                            <p class="text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Trạng thái</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusConfig['color'] }}">
                                <i class="{{ $statusConfig['icon'] }} mr-1"></i>
                                {{ $statusConfig['label'] }}
                            </span>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Thanh toán</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $paymentConfig['color'] }}">
                                {{ $paymentConfig['label'] }}
                            </span>
                        </div>
                        @if($order->payment_method)
                        <div>
                            <label class="text-sm font-medium text-gray-700">Phương thức thanh toán</label>
                            <p class="text-gray-900">
                                @switch($order->payment_method)
                                    @case('cod')
                                        Thanh toán khi nhận hàng
                                        @break
                                    @case('bank_transfer')
                                        Chuyển khoản ngân hàng
                                        @break
                                    @case('online')
                                        Thanh toán online
                                        @break
                                    @default
                                        {{ $order->payment_method }}
                                @endswitch
                            </p>
                        </div>
                        @endif
                    </div>

                    @if($order->note)
                    <div class="mt-4">
                        <label class="text-sm font-medium text-gray-700">Ghi chú</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg mt-1">{{ $order->note }}</p>
                    </div>
                    @endif
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Sản phẩm đã đặt</h2>
                    
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4 p-4 border rounded-lg">
                                @if($item->product && $item->product->productImages->first())
                                    <img src="{{ asset('storage/' . $item->product->productImages->first()->image_link) }}" 
                                         alt="{{ $item->product_name }}"
                                         class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900">{{ $item->product_name }}</h3>
                                    <div class="flex items-center gap-4 mt-1">
                                        <span class="text-sm text-gray-600">{{ number_format($item->price) }}đ</span>
                                        <span class="text-sm text-gray-600">x {{ $item->quantity }}</span>
                                    </div>
                                </div>
                                
                                <div class="text-right">
                                    <div class="font-semibold text-gray-900">{{ number_format($item->subtotal) }}đ</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="space-y-6">
                <!-- Summary -->
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Tổng kết đơn hàng</h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Số lượng sản phẩm:</span>
                            <span class="font-medium">{{ $order->items->sum('quantity') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tạm tính:</span>
                            <span class="font-medium">{{ number_format($order->total) }}đ</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Phí vận chuyển:</span>
                            <span class="font-medium text-green-600">Miễn phí</span>
                        </div>
                        <hr>
                        <div class="flex justify-between text-lg font-semibold">
                            <span>Tổng cộng:</span>
                            <span class="text-red-600">{{ number_format($order->total) }}đ</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Info -->
                @if($order->shipping_address || $order->shipping_name || $order->shipping_phone)
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Thông tin giao hàng</h2>
                    
                    <div class="space-y-3">
                        @if($order->shipping_name)
                        <div>
                            <label class="text-sm font-medium text-gray-700">Người nhận</label>
                            <p class="text-gray-900">{{ $order->shipping_name }}</p>
                        </div>
                        @endif
                        
                        @if($order->shipping_phone)
                        <div>
                            <label class="text-sm font-medium text-gray-700">Số điện thoại</label>
                            <p class="text-gray-900">{{ $order->shipping_phone }}</p>
                        </div>
                        @endif
                        
                        @if($order->shipping_email)
                        <div>
                            <label class="text-sm font-medium text-gray-700">Email</label>
                            <p class="text-gray-900">{{ $order->shipping_email }}</p>
                        </div>
                        @endif
                        
                        @if($order->shipping_address)
                        <div>
                            <label class="text-sm font-medium text-gray-700">Địa chỉ</label>
                            <p class="text-gray-900">{{ $order->shipping_address }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Thao tác</h2>
                    
                    <div class="space-y-3">
                        @if($order->status === 'pending')
                            <form action="{{ route('customer.orders.cancel', $order->order_number) }}" method="POST" 
                                  onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                    Hủy đơn hàng
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('customer.orders.index') }}" 
                           class="block w-full px-4 py-2 bg-gray-600 text-white text-center rounded-lg hover:bg-gray-700 transition-colors">
                            Quay lại danh sách
                        </a>
                        
                        <a href="{{ route('ecomerce.index') }}" 
                           class="block w-full px-4 py-2 bg-green-600 text-white text-center rounded-lg hover:bg-green-700 transition-colors">
                            Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
