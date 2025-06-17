<?php

namespace App\Filament\Admin\Resources\PostResource\Pages;

use App\Filament\Admin\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    public function getTitle(): string
    {
        return 'Chỉnh sửa Bài viết';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Xóa'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Ở lại trang edit thay vì chuyển về list
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Bài viết đã được cập nhật thành công';
    }

    protected function getSavedNotification(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
            ->success()
            ->title('✅ Lưu thành công!')
            ->body('Bài viết đã được cập nhật. Nội dung chi tiết (bao gồm ảnh GIF) đã được lưu và hiển thị.')
            ->duration(5000)
            ->actions([
                \Filament\Notifications\Actions\Action::make('refresh')
                    ->label('🔄 Refresh trang')
                    ->button()
                    ->action(fn () => redirect()->to(request()->url()))
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
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