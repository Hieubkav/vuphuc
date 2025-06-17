<?php

namespace App\Filament\Admin\Resources\OrderResource\Pages;

use App\Filament\Admin\Resources\OrderResource;
use App\Filament\Admin\Pages\BaseListRecords;
use Filament\Actions;

class ListOrders extends BaseListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tạo đơn hàng mới'),
        ];
    }

    public function getTitle(): string
    {
        return 'Quản lý Đơn hàng';
    }
}
