<?php

namespace App\Filament\Admin\Resources\CarouselResource\Pages;

use App\Filament\Admin\Resources\CarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarousels extends ListRecords
{
    protected static string $resource = CarouselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}