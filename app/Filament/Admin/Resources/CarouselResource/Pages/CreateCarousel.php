<?php

namespace App\Filament\Admin\Resources\CarouselResource\Pages;

use App\Filament\Admin\Resources\CarouselResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCarousel extends CreateRecord
{
    protected static string $resource = CarouselResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}