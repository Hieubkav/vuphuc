<div class="space-y-3">
    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-2.5 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabs -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="flex border-b border-gray-200">
            <button wire:click="switchTab('info')"
                    class="flex-1 py-2.5 px-3 text-sm font-medium transition-colors {{ $activeTab === 'info' ? 'bg-red-50 text-red-600 border-b-2 border-red-600' : 'text-gray-600 hover:text-gray-900' }}">
                Thông tin
            </button>
            <button wire:click="switchTab('password')"
                    class="flex-1 py-2.5 px-3 text-sm font-medium transition-colors {{ $activeTab === 'password' ? 'bg-red-50 text-red-600 border-b-2 border-red-600' : 'text-gray-600 hover:text-gray-900' }}">
                Mật khẩu
            </button>
        </div>

        <!-- Tab Content -->
        <div class="p-4 sm:p-5">
            <!-- Info Tab -->
            @if($activeTab === 'info')
                <form wire:submit="updateInfo" class="space-y-3">
                    <input type="text"
                           wire:model="name"
                           class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all"
                           placeholder="Họ và tên">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    @if(Auth::guard('customer')->user()->email)
                        <input type="email"
                               value="{{ Auth::guard('customer')->user()->email }}"
                               readonly
                               class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed"
                               placeholder="Email (không thể thay đổi)">
                    @endif

                    @if(Auth::guard('customer')->user()->phone)
                        <input type="tel"
                               value="{{ Auth::guard('customer')->user()->phone }}"
                               readonly
                               class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed"
                               placeholder="Số điện thoại (không thể thay đổi)">
                    @endif

                    <textarea wire:model="address"
                              rows="2"
                              class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all resize-none"
                              placeholder="Địa chỉ"></textarea>
                    @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    <button type="submit"
                            class="w-full bg-red-600 text-white py-2 text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                        <span wire:loading.remove wire:target="updateInfo">Cập nhật</span>
                        <span wire:loading wire:target="updateInfo">Đang cập nhật...</span>
                    </button>
                </form>
            @endif

            <!-- Password Tab -->
            @if($activeTab === 'password')
                <form wire:submit="updatePassword" class="space-y-3">
                    <input type="password"
                           wire:model="current_password"
                           class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all"
                           placeholder="Mật khẩu hiện tại">
                    @error('current_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    <input type="password"
                           wire:model="new_password"
                           class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all"
                           placeholder="Mật khẩu mới">
                    @error('new_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    <input type="password"
                           wire:model="new_password_confirmation"
                           class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all"
                           placeholder="Xác nhận mật khẩu mới">

                    <button type="submit"
                            class="w-full bg-red-600 text-white py-2 text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                        <span wire:loading.remove wire:target="updatePassword">Đổi mật khẩu</span>
                        <span wire:loading wire:target="updatePassword">Đang cập nhật...</span>
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
