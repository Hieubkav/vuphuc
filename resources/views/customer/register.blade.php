@extends('layouts.shop')

@section('content')
<div class="min-h-screen bg-white flex items-center justify-center py-4 px-3">
    <div class="w-full max-w-xs sm:max-w-sm">
        <!-- Header -->
        <div class="text-center mb-4">
            <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h1 class="text-xl font-semibold text-gray-900">Đăng ký</h1>
        </div>

        <!-- Form -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 sm:p-5">
            @if ($errors->any())
                <div class="mb-3 p-2.5 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('customer.register') }}" class="space-y-2.5">
                @csrf

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all"
                       placeholder="Họ và tên *">

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all"
                       placeholder="Email">

                <input type="tel"
                       name="phone"
                       value="{{ old('phone') }}"
                       class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all"
                       placeholder="Số điện thoại">

                <input type="password"
                       name="password"
                       required
                       class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all"
                       placeholder="Mật khẩu *">

                <input type="password"
                       name="password_confirmation"
                       required
                       class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all"
                       placeholder="Xác nhận mật khẩu *">

                <div class="text-xs text-gray-500 py-1">
                    Cần ít nhất email hoặc số điện thoại
                </div>

                <button type="submit"
                        class="w-full bg-red-600 text-white py-2 text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                    Đăng ký
                </button>
            </form>

        </div>

        <!-- Links -->
        <div class="mt-3 text-center space-y-1.5">
            <div class="text-sm text-gray-600">
                Đã có tài khoản?
                <a href="{{ route('customer.login') }}" class="text-red-600 hover:text-red-700 font-medium">Đăng nhập</a>
            </div>
            <a href="{{ route('storeFront') }}" class="block text-xs text-gray-500 hover:text-gray-700">← Trang chủ</a>
        </div>
    </div>
</div>
@endsection
