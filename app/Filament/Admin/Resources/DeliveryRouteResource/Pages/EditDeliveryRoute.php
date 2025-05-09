<?php

namespace App\Filament\Admin\Resources\DeliveryRouteResource\Pages;

use App\Filament\Admin\Resources\DeliveryRouteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeliveryRoute extends EditRecord
{
    protected static string $resource = DeliveryRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}