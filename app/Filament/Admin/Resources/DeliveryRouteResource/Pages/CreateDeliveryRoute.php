<?php

namespace App\Filament\Admin\Resources\DeliveryRouteResource\Pages;

use App\Filament\Admin\Resources\DeliveryRouteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDeliveryRoute extends CreateRecord
{
    protected static string $resource = DeliveryRouteResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}