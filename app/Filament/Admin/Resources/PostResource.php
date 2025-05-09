<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PostResource\Pages;
use App\Models\Post;
use App\Services\ImageService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    
    protected static ?string $navigationGroup = 'Tin Tức';
    
    protected static ?string $navigationLabel = 'Bài viết';
    
    protected static ?int $navigationSort = 20;
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin bài viết')
                    ->schema([
                        TextInput::make('title')
                            ->label('Tiêu đề')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', Str::slug($state))),
                            
                        TextInput::make('slug')
                            ->label('Đường dẫn')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                            
                        Select::make('post_category_id')
                            ->relationship('category', 'name')
                            ->label('Danh mục')
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Tên danh mục')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->label('Đường dẫn')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->searchable(),
                            
                        FileUpload::make('thumbnail') // Giữ tên trường là 'thumbnail' để khớp với database
                            ->label('Hình đại diện')
                            ->image()
                            ->directory('posts')
                            ->visibility('public')
                            ->maxSize(1024)
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth(1200)
                            ->imageResizeTargetHeight(630)
                            ->nullable()
                            // Sử dụng saveUploadedFileUsing để xử lý file với ImageService
                            ->saveUploadedFileUsing(function ($file, $get) {
                                $imageService = app(ImageService::class);
                                return $imageService->saveImage(
                                    $file, 
                                    'posts', 
                                    1200,  // width
                                    630,   // height cho tỉ lệ 1.91:1 (chuẩn Facebook/Twitter card)
                                    85     // quality
                                );
                            }),
                    ])->columns(2),
                    
                Section::make('Nội dung bài viết')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Nội dung chi tiết')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('posts')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                    
                Section::make('Cấu hình hiển thị')
                    ->schema([
                        Toggle::make('featured')
                            ->label('Nổi bật')
                            ->default(false)
                            ->onColor('success')
                            ->offColor('danger'),
                            
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
                ImageColumn::make('thumbnail') // Giữ tên trường là 'thumbnail' để khớp với database
                    ->label('Hình đại diện')
                    ->defaultImageUrl(fn() => asset('images/default-post.jpg'))
                    ->circular(),
                    
                TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                    
                TextColumn::make('category.name')
                    ->label('Danh mục')
                    ->searchable()
                    ->sortable(),
                
                ToggleColumn::make('featured')
                    ->label('Nổi bật')
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
                Tables\Filters\SelectFilter::make('post_category_id')
                    ->relationship('category', 'name')
                    ->label('Danh mục'),
                    
                Tables\Filters\TernaryFilter::make('featured')
                    ->label('Nổi bật'),
                    
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Hiển thị'),
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
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}