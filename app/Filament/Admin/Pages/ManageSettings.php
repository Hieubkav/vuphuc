<?php

namespace App\Filament\Admin\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?string $navigationGroup = 'Hệ Thống';

    protected static string $view = 'filament.admin.pages.manage-settings';

    protected static ?string $title = 'Cài Đặt Website';

    protected static ?string $navigationLabel = 'Cài Đặt Website';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::first() ?? new Setting();
        $this->form->fill($settings->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin công ty')
                    ->schema([
                        TextInput::make('company_name')
                            ->label('Tên công ty')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Số điện thoại')
                            ->required()
                            ->tel()
                            ->maxLength(20),
                        FileUpload::make('logo_url')
                            ->label('Logo')
                            ->image()
                            ->directory('settings')
                            ->imageResizeMode('cover')
                            // ->imageCropAspectRatio('16:9')
                            // ->imageResizeTargetWidth('1280')
                            // ->imageResizeTargetHeight('720')
                            ,
                    ])
                    ->columns(2),

                Section::make('Liên kết mạng xã hội')
                    ->schema([
                        TextInput::make('youtube_url')
                            ->label('YouTube')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('zalo_url')
                            ->label('Zalo')
                            ->maxLength(255),
                        TextInput::make('facebook_url')
                            ->label('Facebook')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(3),

                Section::make('Địa chỉ')
                    ->schema([
                        Textarea::make('meta_description')
                            ->label('Mô tả meta (SEO)')
                            ->rows(3)
                            ->maxLength(255),
                        Textarea::make('address1')
                            ->label('Địa chỉ 1')
                            ->rows(2)
                            ->maxLength(255),
                        Textarea::make('address2')
                            ->label('Địa chỉ 2')
                            ->rows(2)
                            ->maxLength(255),
                        Textarea::make('address3')
                            ->label('Địa chỉ 3')
                            ->rows(2)
                            ->maxLength(255),
                        Textarea::make('address4')
                            ->label('Địa chỉ 4')
                            ->rows(2)
                            ->maxLength(255),
                        Textarea::make('address5')
                            ->label('Địa chỉ 5')
                            ->rows(2)
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        $settings = Setting::first();
        
        if ($settings) {
            $settings->update($data);
        } else {
            Setting::create($data);
        }

        Cache::forget('settings');

        Notification::make()
            ->title('Cài đặt đã được lưu')
            ->success()
            ->send();
    }
}