<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\ImageService;

class PostObserver
{
    protected $imageService;
    protected $oldThumbnails = []; // Array to store old thumbnails by post ID

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        // Hình ảnh đã được xử lý trong form Filament
    }

    /**
     * Handle the Post "updating" event.
     */
    public function updating(Post $post): void
    {
        if ($post->isDirty('thumbnail') && $post->getOriginal('thumbnail')) {
            // Lưu đường dẫn hình ảnh cũ vào mảng tạm thời để xóa sau
            $this->oldThumbnails[$post->id] = $post->getOriginal('thumbnail');
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        // Nếu có hình ảnh cũ cần xóa
        if (isset($this->oldThumbnails[$post->id])) {
            $this->imageService->deleteImage($this->oldThumbnails[$post->id]);
            unset($this->oldThumbnails[$post->id]);
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        // Xóa hình ảnh khi xóa bài viết
        if ($post->thumbnail) {
            $this->imageService->deleteImage($post->thumbnail);
        }
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
