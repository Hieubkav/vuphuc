<x-filament-panels::page>
    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">
                📊 Phân tích lượt truy cập website
            </h2>
            <p class="text-gray-600 mb-4">
                Trang này hiển thị thống kê chi tiết về lượt truy cập website, bao gồm số lượt truy cập hôm nay,
                tổng số lượt truy cập, và top nội dung được xem nhiều nhất.
            </p>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>🔄 Auto-refresh:</strong> Tất cả widget sẽ tự động cập nhật mỗi 5 giây để hiển thị dữ liệu realtime.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-medium text-blue-900 mb-2">🌐 Tracking Website</h3>
                    <p class="text-blue-700">Tự động ghi nhận mọi lượt truy cập vào website</p>
                </div>
                
                <div class="bg-green-50 p-4 rounded-lg">
                    <h3 class="font-medium text-green-900 mb-2">📝 Tracking Bài viết</h3>
                    <p class="text-green-700">Theo dõi lượt xem từng bài viết cụ thể</p>
                </div>
                
                <div class="bg-purple-50 p-4 rounded-lg">
                    <h3 class="font-medium text-purple-900 mb-2">🛍️ Tracking Sản phẩm</h3>
                    <p class="text-purple-700">Theo dõi lượt xem từng sản phẩm cụ thể</p>
                </div>
            </div>
        </div>

        <x-filament-widgets::widgets
            :columns="$this->getColumns()"
            :data="
                [
                    ...(property_exists($this, 'filters') ? ['filters' => $this->filters] : []),
                    ...$this->getWidgetData(),
                ]
            "
            :widgets="$this->getVisibleWidgets()"
        />
    </div>
</x-filament-panels::page>
