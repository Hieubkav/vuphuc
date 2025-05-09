<?php

namespace App\Observers;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceObserver
{
    /**
     * Handle the Service "created" event.
     */
    public function created(Service $service): void
    {
        // Không cần xử lý vì hình ảnh đã được Filament xử lý
    }

    /**
     * Handle the Service "updated" event.
     */
    public function updated(Service $service): void
    {
        //
    }

    /**
     * Handle the Service "updating" event.
     */
    public function updating(Service $service): void
    {
        // Nếu hình ảnh thay đổi, xóa hình ảnh cũ ngay lập tức
        if ($service->isDirty('image') && $service->getOriginal('image')) {
            $oldImage = $service->getOriginal('image');
            // Chỉ xóa hình cũ nếu nó khác với hình mới
            if ($oldImage !== $service->image) {
                Storage::disk('public')->delete($oldImage);
            }
        }
    }

    /**
     * Handle the Service "deleted" event.
     */
    public function deleted(Service $service): void
    {
        // Xóa hình ảnh khi xóa service
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
    }

    /**
     * Handle the Service "restored" event.
     */
    public function restored(Service $service): void
    {
        // Không cần xử lý
    }

    /**
     * Handle the Service "force deleted" event.
     */
    public function forceDeleted(Service $service): void
    {
        // Giống với deleted
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
    }
}
