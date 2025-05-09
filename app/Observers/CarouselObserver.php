<?php

namespace App\Observers;

use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;

class CarouselObserver
{
    /**
     * Handle the Carousel "created" event.
     */
    public function created(Carousel $carousel): void
    {
        // Không cần xử lý thêm cho sự kiện created
    }

    /**
     * Handle the Carousel "updating" event.
     */
    public function updating(Carousel $carousel): void
    {
        // Nếu hình ảnh thay đổi, xóa hình ảnh cũ ngay lập tức
        if ($carousel->isDirty('image') && $carousel->getOriginal('image')) {
            $oldImage = $carousel->getOriginal('image');
            // Chỉ xóa hình cũ nếu nó khác với hình mới
            if ($oldImage !== $carousel->image) {
                Storage::disk('public')->delete($oldImage);
            }
        }
    }

    /**
     * Handle the Carousel "deleted" event.
     */
    public function deleted(Carousel $carousel): void
    {
        // Xóa hình ảnh khi xóa carousel
        if ($carousel->image) {
            Storage::disk('public')->delete($carousel->image);
        }
    }

    /**
     * Handle the Carousel "restored" event.
     */
    public function restored(Carousel $carousel): void
    {
        // Không cần xử lý
    }

    /**
     * Handle the Carousel "force deleted" event.
     */
    public function forceDeleted(Carousel $carousel): void
    {
        // Giống với deleted
        if ($carousel->image) {
            Storage::disk('public')->delete($carousel->image);
        }
    }
}
