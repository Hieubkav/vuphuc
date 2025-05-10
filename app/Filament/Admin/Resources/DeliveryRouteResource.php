<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DeliveryRouteResource\Pages;
use App\Models\DeliveryRoute;
use App\Services\ImageService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class DeliveryRouteResource extends Resource
{
    protected static ?string $model = DeliveryRoute::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    
    protected static ?string $navigationGroup = 'Quản lý sản phẩm';
    
    protected static ?string $navigationLabel = 'Tuyến giao hàng';
    
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin tuyến giao hàng')
                    ->schema([
                        TextInput::make('name')
                            ->label('Tên tuyến')
                            ->required()
                            ->maxLength(255),
                            
                        FileUpload::make('image')
                            ->label('Hình ảnh')
                            ->image()
                            ->directory('delivery-routes')
                            ->visibility('public')
                            ->maxSize(4024)
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth(800)
                            ->imageResizeTargetHeight(600)
                            ->nullable()
                            ->saveUploadedFileUsing(function ($file) {
                                $imageService = app(ImageService::class);
                                return $imageService->saveImage(
                                    $file, 
                                    'delivery-routes', 
                                    800,  // width
                                    600,  // height
                                    100    // quality
                                );
                            }),
                            
                        Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(3)
                            ->maxLength(1000),
                    ])->columns(2),
                    
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
                TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
                    
                ImageColumn::make('image')
                    ->label('Hình ảnh')
                    ->circular()
                    ->defaultImageUrl(fn() => asset('images/default-route.jpg')),
                    
                TextColumn::make('name')
                    ->label('Tên tuyến')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('description')
                    ->label('Mô tả')
                    ->limit(50)
                    ->searchable(),
                    
                ToggleColumn::make('status')
                    ->label('Hiển thị')
                    ->sortable(),
                    
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDeliveryRoutes::route('/'),
            'create' => Pages\CreateDeliveryRoute::route('/create'),
            'edit' => Pages\EditDeliveryRoute::route('/{record}/edit'),
        ];
    }    

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}