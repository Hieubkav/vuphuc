<?php

namespace App\Observers;

use App\Models\ProductCategory;

class ProductCategoryObserver
{
    /**
     * Handle the ProductCategory "created" event.
     */
    public function created(ProductCategory $productCategory): void
    {
        //
    }

    /**
     * Handle the ProductCategory "updated" event.
     */
    public function updated(ProductCategory $productCategory): void
    {
        //
    }

    /**
     * Handle the ProductCategory "deleted" event.
     */
    public function deleted(ProductCategory $productCategory): void
    {
        // Kiểm tra xem danh mục có sản phẩm không trước khi xóa
        if ($productCategory->products()->count() > 0) {
            // Có thể log hoặc thực hiện hành động khác ở đây
        }
    }

    /**
     * Handle the ProductCategory "restored" event.
     */
    public function restored(ProductCategory $productCategory): void
    {
        //
    }

    /**
     * Handle the ProductCategory "force deleted" event.
     */
    public function forceDeleted(ProductCategory $productCategory): void
    {
        //
    }
}
