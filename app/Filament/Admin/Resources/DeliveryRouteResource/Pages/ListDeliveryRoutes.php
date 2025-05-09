<?php

namespace App\Filament\Admin\Resources\DeliveryRouteResource\Pages;

use App\Filament\Admin\Resources\DeliveryRouteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeliveryRoutes extends ListRecords
{
    protected static string $resource = DeliveryRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}