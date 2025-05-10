<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PartnerResource\Pages;
use App\Models\Partner;
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

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    
    protected static ?string $navigationGroup = 'Quản lý nội dung';
    
    protected static ?string $navigationLabel = 'Quản lý đối tác';
    
    protected static ?int $navigationSort = 25;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin đối tác')
                    ->schema([
                        TextInput::make('name')
                            ->label('Tên đối tác')
                            ->required()
                            ->maxLength(255),
                            
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->directory('partners')
                            ->visibility('public')
                            ->imageResizeMode('contain')
                            ->imageResizeTargetWidth(300)
                            ->imageResizeTargetHeight(200)
                            ->saveUploadedFileUsing(function ($file) {
                                $imageService = app(ImageService::class);
                                return $imageService->saveImage(
                                    $file, 
                                    'partners', 
                                    300,  // width
                                    200,  // height
                                    100    // quality - cao hơn cho logo để giữ độ sắc nét
                                );
                            }),
                            
                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255),
                            
                        Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(3)
                            ->maxLength(1000),
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
                TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
                    
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->height(60),
                    
                TextColumn::make('name')
                    ->label('Tên đối tác')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('website')
                    ->label('Website')
                    // ->url(fn (Partner $record): string => $record->website)
                    ->searchable(),
                    
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
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