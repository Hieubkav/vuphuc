<?php

namespace App\Filament\Admin\Resources\PostResource\Pages;

use App\Filament\Admin\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    public function getTitle(): string
    {
        return 'Thêm Bài viết Mới';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Bài viết đã được thêm thành công';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Tự động tạo SEO title nếu trống
        if (empty($data['seo_title']) && !empty($data['title'])) {
            $data['seo_title'] = PostResource::generateSeoTitle($data['title']);
        }

        // Tự động tạo SEO description nếu trống
        if (empty($data['seo_description']) && !empty($data['content'])) {
            $data['seo_description'] = PostResource::generateSeoDescription($data['content']);
        }

        // Tự động copy thumbnail làm OG image nếu OG image trống
        if (empty($data['og_image_link']) && !empty($data['thumbnail'])) {
            $data['og_image_link'] = $data['thumbnail'];
        }

        return $data;
    }
}