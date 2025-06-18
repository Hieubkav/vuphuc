<?php

namespace App\Filament\Admin\Widgets;

use App\Models\PostView;
use App\Models\ProductView;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TopContentWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '5s';

    protected function getStats(): array
    {
        // Lấy top 3 bài viết
        $topPosts = PostView::selectRaw('post_id, COUNT(*) as total_views, COUNT(DISTINCT ip_address) as unique_views')
            ->with('post')
            ->groupBy('post_id')
            ->orderBy('total_views', 'desc')
            ->limit(3)
            ->get();

        // Lấy top 3 sản phẩm
        $topProducts = ProductView::selectRaw('product_id, COUNT(*) as total_views, COUNT(DISTINCT ip_address) as unique_views')
            ->with('product')
            ->groupBy('product_id')
            ->orderBy('total_views', 'desc')
            ->limit(3)
            ->get();

        $stats = [];

        // Thêm stats cho top posts
        foreach ($topPosts as $index => $postView) {
            $post = $postView->post;
            if ($post) {
                $stats[] = Stat::make("Top " . ($index + 1) . " Bài viết", $post->title)
                    ->description("{$postView->total_views} lượt xem • {$postView->unique_views} người khác nhau")
                    ->descriptionIcon('heroicon-m-document-text')
                    ->color('info');
            }
        }

        // Thêm stats cho top products
        foreach ($topProducts as $index => $productView) {
            $product = $productView->product;
            if ($product) {
                $stats[] = Stat::make("Top " . ($index + 1) . " Sản phẩm", $product->name)
                    ->description("{$productView->total_views} lượt xem • {$productView->unique_views} người khác nhau")
                    ->descriptionIcon('heroicon-m-shopping-bag')
                    ->color('success');
            }
        }

        // Nếu không có dữ liệu, hiển thị thông báo
        if (empty($stats)) {
            $stats[] = Stat::make('Chưa có dữ liệu', 'Chưa có lượt xem nào được ghi nhận')
                ->description('Hãy truy cập website để bắt đầu tracking')
                ->descriptionIcon('heroicon-m-eye-slash')
                ->color('gray');
        }

        return $stats;
    }


}
