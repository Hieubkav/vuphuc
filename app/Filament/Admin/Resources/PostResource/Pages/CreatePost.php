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
        // Chuyển đến trang edit của bài viết vừa tạo
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Bài viết đã được thêm thành công';
    }

    protected function getCreatedNotification(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
            ->success()
            ->title('✅ Tạo thành công!')
            ->body('Bài viết đã được tạo. Bạn đang ở trang chỉnh sửa để tiếp tục hoàn thiện nội dung.')
            ->duration(5000)
            ->actions([
                \Filament\Notifications\Actions\Action::make('viewList')
                    ->label('📋 Xem danh sách')
                    ->button()
                    ->url($this->getResource()::getUrl('index'))
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Tự động tạo content từ content_builder
        if (!empty($data['content_builder'])) {
            $data['content'] = $this->extractContentFromBuilder($data['content_builder']);
        } else {
            // Nếu không có content_builder, đặt content rỗng
            $data['content'] = '';
        }

        // Tự động tạo SEO title nếu trống
        if (empty($data['seo_title']) && !empty($data['title'])) {
            $data['seo_title'] = PostResource::generateSeoTitle($data['title']);
        }

        // Tự động tạo SEO description nếu trống từ content đã được tạo
        if (empty($data['seo_description']) && !empty($data['content'])) {
            $data['seo_description'] = PostResource::generateSeoDescription($data['content']);
        }

        // Tự động copy thumbnail làm OG image nếu OG image trống
        if (empty($data['og_image_link']) && !empty($data['thumbnail'])) {
            $data['og_image_link'] = $data['thumbnail'];
        }

        return $data;
    }

    /**
     * Trích xuất nội dung text từ content_builder
     */
    private function extractContentFromBuilder(array $contentBuilder): string
    {
        $content = '';

        foreach ($contentBuilder as $block) {
            if (!isset($block['type']) || !isset($block['data'])) {
                continue;
            }

            switch ($block['type']) {
                case 'paragraph':
                    if (isset($block['data']['content'])) {
                        $content .= strip_tags($block['data']['content']) . "\n\n";
                    }
                    break;

                case 'heading':
                    if (isset($block['data']['content'])) {
                        $content .= strip_tags($block['data']['content']) . "\n\n";
                    }
                    break;

                case 'list':
                    if (isset($block['data']['items']) && is_array($block['data']['items'])) {
                        foreach ($block['data']['items'] as $item) {
                            $content .= '- ' . strip_tags($item) . "\n";
                        }
                        $content .= "\n";
                    }
                    break;

                case 'quote':
                    if (isset($block['data']['content'])) {
                        $content .= '"' . strip_tags($block['data']['content']) . '"' . "\n\n";
                    }
                    break;

                case 'image':
                    if (isset($block['data']['caption'])) {
                        $content .= strip_tags($block['data']['caption']) . "\n\n";
                    }
                    break;

                case 'video':
                    if (isset($block['data']['caption'])) {
                        $content .= strip_tags($block['data']['caption']) . "\n\n";
                    }
                    break;
            }
        }

        return trim($content);
    }
}