<?php

namespace App\Filament\Admin\Pages;

use App\Models\WebDesign;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;

class ManageWebDesign extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    
    protected static ?string $navigationGroup = 'Hệ Thống';

    protected static string $view = 'filament.admin.pages.manage-web-design';

    protected static ?string $title = 'Thiết Kế Web';

    protected static ?string $navigationLabel = 'Thiết Kế Web';

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        $webDesign = WebDesign::first() ?? new WebDesign();
        $this->form->fill($webDesign->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Cài đặt dịch vụ')
                    ->schema([
                        TextInput::make('service_order')
                            ->label('Thứ tự hiển thị dịch vụ')
                            ->integer()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                        Toggle::make('service_status')
                            ->label('Hiển thị khu vực dịch vụ')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])
                    ->columns(2),

                Section::make('Cài đặt băng chuyền')
                    ->schema([
                        TextInput::make('carousel_order')
                            ->label('Thứ tự hiển thị băng chuyền')
                            ->integer()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                        Toggle::make('carousel_status')
                            ->label('Hiển thị khu vực băng chuyền')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        $webDesign = WebDesign::first();
        
        if ($webDesign) {
            $webDesign->update($data);
        } else {
            WebDesign::create($data);
        }

        Cache::forget('web_design');

        Notification::make()
            ->title('Thiết kế web đã được lưu')
            ->success()
            ->send();
    }
}