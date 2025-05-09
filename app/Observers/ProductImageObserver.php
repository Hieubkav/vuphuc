<?php

namespace App\Observers;

use App\Models\ProductImage;
use App\Services\ImageService;

class ProductImageObserver
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Handle the ProductImage "created" event.
     */
    public function created(ProductImage $productImage): void
    {
        // Hình ảnh đã được xử lý trong form Filament
    }

    /**
     * Handle the ProductImage "updating" event.
     */
    public function updating(ProductImage $productImage): void
    {
        if ($productImage->isDirty('image') && $productImage->getOriginal('image')) {
            // Lưu đường dẫn hình ảnh cũ vào thuộc tính tạm thời để xóa sau
            $productImage->old_image = $productImage->getOriginal('image');
        }
    }

    /**
     * Handle the ProductImage "updated" event.
     */
    public function updated(ProductImage $productImage): void
    {
        // Nếu có hình ảnh cũ cần xóa
        if (isset($productImage->old_image)) {
            $this->imageService->deleteImage($productImage->old_image);
            unset($productImage->old_image);
        }
    }

    /**
     * Handle the ProductImage "deleted" event.
     */
    public function deleted(ProductImage $productImage): void
    {
        // Xóa hình ảnh khi xóa record
        if ($productImage->image) {
            $this->imageService->deleteImage($productImage->image);
        }
    }

    /**
     * Handle the ProductImage "restored" event.
     */
    public function restored(ProductImage $productImage): void
    {
        //
    }

    /**
     * Handle the ProductImage "force deleted" event.
     */
    public function forceDeleted(ProductImage $productImage): void
    {
        //
    }
}
