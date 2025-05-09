<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ServiceResource\Pages;
use App\Models\Service;
use App\Services\ImageService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    
    protected static ?string $navigationGroup = 'Quản lý nội dung';
    
    protected static ?string $navigationLabel = 'Dịch vụ';
    
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin dịch vụ')
                    ->schema([
                        TextInput::make('name')
                            ->label('Tên dịch vụ')
                            ->required()
                            ->maxLength(255),
                            
                        FileUpload::make('image')
                            ->label('Hình ảnh')
                            ->image()
                            ->directory('services')
                            ->visibility('public')
                            ->maxSize(4048)
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth(800)
                            ->imageResizeTargetHeight(600)
                            ->nullable()
                            ->saveUploadedFileUsing(function ($file) {
                                $imageService = app(ImageService::class);
                                return $imageService->saveImage(
                                    $file, 
                                    'services', 
                                    800,  // width
                                    600,  // height
                                    100    // quality
                                );
                            }),
                    ])->columns(2),
                    
                Section::make('Nội dung dịch vụ')
                    ->schema([
                        Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(5)
                            ->nullable()
                            ->columnSpanFull(),
                    ]),
                    
                Section::make('Cấu hình hiển thị')
                    ->schema([
                        TextInput::make('order')
                            ->label('Thứ tự hiển thị')
                            ->integer()
                            ->default(0),
                            
                        Toggle::make('status')
                            ->label('Hiển thị')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Hình ảnh')
                    ->defaultImageUrl(fn() => asset('images/default-service.jpg'))
                    ->circular(),
                    
                TextColumn::make('name')
                    ->label('Tên dịch vụ')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                
                TextColumn::make('description')
                    ->label('Mô tả')
                    ->searchable()
                    ->limit(50)
                    ->wrap(),
                    
                TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
                    
                ToggleColumn::make('status')
                    ->label('Hiển thị')
                    ->sortable(),
                    
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('status')
                    ->label('Hiển thị'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}