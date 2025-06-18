<?php

namespace App\Filament\Admin\Pages;

use App\Models\WebDesign;
use App\Services\WebDesignService;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use App\Constants\NavigationGroups;

class ManageWebDesign extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';
    protected static string $view = 'filament.admin.pages.manage-web-design';
    protected static ?string $title = 'Cấu hình giao diện';
    protected static ?string $navigationLabel = 'Cấu hình giao diện';
    protected static ?string $navigationGroup = NavigationGroups::WEBSITE_MANAGEMENT;
    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $this->loadWebDesignData();
    }

    protected function loadWebDesignData(): void
    {
        $this->data = [];

        // Lấy tất cả components từ database
        $components = WebDesign::orderBy('position')->get();

        foreach ($components as $component) {
            $key = $component->component_key;

            $this->data[$key] = [
                'component_name' => $component->component_name,
                'is_active' => $component->is_active,
                'position' => $component->position,
                'settings' => $component->settings ?? [],
            ];

            // Chỉ load content fields cho components cần thiết
            if ($this->shouldShowContentFields($key)) {
                $this->data[$key]['title'] = $component->title;
                $this->data[$key]['subtitle'] = $component->subtitle;
            }

            if ($this->shouldShowMediaFields($key)) {
                $this->data[$key]['image_url'] = $component->image_url;
                $this->data[$key]['video_url'] = $component->video_url;
            }

            if ($this->shouldShowButtonFields($key)) {
                $this->data[$key]['button_text'] = $component->button_text;
                $this->data[$key]['button_url'] = $component->button_url;
            }

            // Content builder fields chỉ cho components cần thiết
            if ($this->shouldShowContentBuilder($key)) {
                // Stats Counter chỉ cần 4 stats
                if ($key === 'stats-counter') {
                    $stats = $this->getContentValue($component, 'stats', []);
                    for ($i = 1; $i <= 4; $i++) {
                        $statIndex = $i - 1;
                        $this->data[$key]["stat_{$i}_number"] = $stats[$statIndex]['number'] ?? '';
                        $this->data[$key]["stat_{$i}_label"] = $stats[$statIndex]['label'] ?? '';
                    }
                } else {
                    // Các components khác có full content builder
                    $this->data[$key]['content_description'] = $this->getContentValue($component, 'description');

                    // Xử lý riêng cho About Us - 4 services cố định
                    if ($key === 'about-us') {
                        $services = $this->getContentValue($component, 'services', []);
                        for ($i = 1; $i <= 4; $i++) {
                            $serviceIndex = $i - 1;
                            $this->data[$key]["service_{$i}_title"] = $services[$serviceIndex]['title'] ?? '';
                            $this->data[$key]["service_{$i}_desc"] = $services[$serviceIndex]['desc'] ?? '';

                            // Xử lý image - nếu là uploaded file thì convert về array
                            $image = $services[$serviceIndex]['image'] ?? '';
                            if ($image && str_starts_with($image, '/storage/')) {
                                // Uploaded file - convert to array format for FileUpload
                                $this->data[$key]["service_{$i}_upload"] = [str_replace('/storage/', '', $image)];
                                $this->data[$key]["service_{$i}_image"] = '';
                            } else {
                                // URL - keep as string
                                $this->data[$key]["service_{$i}_upload"] = [];
                                $this->data[$key]["service_{$i}_image"] = $image;
                            }
                        }
                    } else {
                        $this->data[$key]['content_services'] = $this->getContentValue($component, 'services', []);
                    }

                    $this->data[$key]['content_features'] = $this->convertFeaturesToRepeater($this->getContentValue($component, 'features', []));
                    $this->data[$key]['content_stats'] = $this->getContentValue($component, 'stats', []);
                }

                // Xử lý riêng cho Footer - 3 policies và copyright
                if ($key === 'footer') {
                    $policies = $this->getContentValue($component, 'policies', []);
                    for ($i = 1; $i <= 3; $i++) {
                        $policyIndex = $i - 1;
                        $this->data[$key]["policy_{$i}_title"] = $policies[$policyIndex]['title'] ?? '';
                        $this->data[$key]["policy_{$i}_url"] = $policies[$policyIndex]['url'] ?? '';
                    }
                    $this->data[$key]['copyright'] = $this->getContentValue($component, 'copyright', '');
                }
            }
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getComponentSections())
            ->statePath('data');
    }

    protected function getComponentSections(): array
    {
        $sections = [];
        $components = WebDesign::orderBy('position')->get();

        foreach ($components as $component) {
            $key = $component->component_key;

            $schema = [
                // Cấu hình cơ bản
                Grid::make(3)->schema([
                    Toggle::make("{$key}.is_active")
                        ->label('Hiển thị')
                        ->default($component->is_active)
                        ->inline(false),

                    TextInput::make("{$key}.position")
                        ->label('Thứ tự')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(100)
                        ->default($component->position)
                        ->required(),

                    TextInput::make("{$key}.component_name")
                        ->label('Tên hiển thị')
                        ->default($component->component_name)
                        ->required(),
                ]),
            ];

            // Nội dung chính (chỉ cho components cần thiết)
            if ($this->shouldShowContentFields($key)) {
                $schema[] = Grid::make(2)->schema([
                    TextInput::make("{$key}.title")
                        ->label('Tiêu đề chính')
                        ->default($component->title)
                        ->maxLength(255),

                    TextInput::make("{$key}.subtitle")
                        ->label('Tiêu đề phụ')
                        ->default($component->subtitle)
                        ->maxLength(255),
                ]);
            }

            // Media và liên kết (chỉ cho components cần thiết)
            if ($this->shouldShowMediaFields($key)) {
                $schema[] = Grid::make(2)->schema([
                    TextInput::make("{$key}.image_url")
                        ->label('URL Hình ảnh')
                        ->default($component->image_url)
                        ->nullable()
                        ->helperText('VD: /storage/images/banner.jpg hoặc https://example.com/image.jpg'),

                    TextInput::make("{$key}.video_url")
                        ->label('URL Video')
                        ->default($component->video_url)
                        ->nullable()
                        ->helperText('VD: https://youtube.com/watch?v=... hoặc /storage/videos/intro.mp4'),
                ]);
            }

            // Nút bấm (chỉ cho components cần thiết)
            if ($this->shouldShowButtonFields($key)) {
                $schema[] = Grid::make(2)->schema([
                    TextInput::make("{$key}.button_text")
                        ->label('Text nút bấm')
                        ->default($component->button_text)
                        ->maxLength(100),

                    TextInput::make("{$key}.button_url")
                        ->label('URL nút bấm')
                        ->default($component->button_url)
                        ->nullable()
                        ->helperText('VD: /gioi-thieu, /san-pham hoặc https://external-site.com'),
                ]);
            }

            // Content Builder (chỉ cho components không có model riêng)
            if ($this->shouldShowContentBuilder($key)) {
                $schema[] = $this->getContentBuilder($key, $component);
            }

            $sections[] = Section::make($component->component_name)
                ->description($this->getComponentDescription($key))
                ->schema($schema)
                ->collapsible()
                ->collapsed($component->component_key !== 'about-us'); // Mở about-us mặc định
        }

        return $sections;
    }

    protected function shouldShowContentBuilder(string $key): bool
    {
        // Các components có model riêng hoặc chỉ cần basic fields
        $componentsWithoutContentBuilder = [
            'hero-banner', // Có Slider model
            'featured-products', // Có Product model
            'services', // Có Post model type service
            'courses-overview', // Có Post model type course
            'blog-posts', // Có Post model type news
            'homepage-cta', // Chỉ cần 4 fields cơ bản
        ];

        return !in_array($key, $componentsWithoutContentBuilder);
    }

    protected function shouldShowContentFields(string $key): bool
    {
        // Các components không cần title/subtitle
        $componentsWithoutContent = [
            'hero-banner',      // Có trong Slider
            'stats-counter',    // Chỉ cần 4 stats
        ];
        return !in_array($key, $componentsWithoutContent);
    }

    protected function shouldShowMediaFields(string $key): bool
    {
        // Bỏ media fields cho tất cả components vì không cần thiết
        // Hình ảnh sẽ được quản lý riêng trong từng tính năng
        return false;
    }

    protected function shouldShowButtonFields(string $key): bool
    {
        // Các components không cần button
        $componentsWithoutButton = [
            'hero-banner',      // Có button trong Slider
            'stats-counter',    // Chỉ hiển thị số liệu
        ];
        return !in_array($key, $componentsWithoutButton);
    }

    protected function getComponentDescription(string $key): string
    {
        $descriptions = [
            'hero-banner' => 'Chỉ cấu hình ẩn/hiện. Nội dung được quản lý trong Slider.',
            'featured-products' => 'Chỉ cấu hình ẩn/hiện và thứ tự. Sản phẩm được quản lý trong Products.',
            'blog-posts' => 'Chỉ cấu hình ẩn/hiện và thứ tự. Bài viết được quản lý trong Posts.',
            'partners' => 'Chỉ cấu hình ẩn/hiện và thứ tự. Đối tác được quản lý riêng.',
            'stats-counter' => 'Cấu hình hiển thị và nội dung thống kê.',
        ];

        return $descriptions[$key] ?? 'Cấu hình nội dung và hiển thị';
    }

    protected function getAboutUsServicesBuilder(string $key, $component)
    {
        $services = $this->getContentValue($component, 'services', []);

        // Đảm bảo có đủ 4 services với default values
        $defaultServices = [
            ['title' => 'Bánh Ngọt Cao Cấp', 'desc' => 'Sản phẩm chất lượng từ nguyên liệu tự nhiên', 'image' => ''],
            ['title' => 'Quy Trình Chuẩn', 'desc' => 'Kiểm soát chất lượng nghiêm ngặt', 'image' => ''],
            ['title' => 'Đào Tạo Chuyên Nghiệp', 'desc' => 'Hỗ trợ kỹ thuật và đào tạo', 'image' => ''],
            ['title' => 'Đội Ngũ Chuyên Gia', 'desc' => 'Kinh nghiệm nhiều năm trong ngành', 'image' => ''],
        ];

        for ($i = 0; $i < 4; $i++) {
            if (!isset($services[$i])) {
                $services[$i] = $defaultServices[$i];
            } else {
                // Merge với default để đảm bảo có đủ fields
                $services[$i] = array_merge($defaultServices[$i], $services[$i]);
            }
        }

        return Section::make('4 Dịch vụ chính (cố định)')
            ->description('Chỉnh sửa nội dung 4 dịch vụ chính của công ty')
            ->schema([
                // Service 1
                Section::make('Dịch vụ 1')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make("{$key}.service_1_title")
                                ->label('Tiêu đề')
                                ->default($services[0]['title'] ?? '')
                                ->required(),
                            TextInput::make("{$key}.service_1_desc")
                                ->label('Mô tả')
                                ->default($services[0]['desc'] ?? ''),
                        ]),

                        Tabs::make('Hình ảnh')
                            ->tabs([
                                Tabs\Tab::make('Upload')
                                    ->schema([
                                        FileUpload::make("{$key}.service_1_upload")
                                            ->label('Upload hình ảnh')
                                            ->image()
                                            ->directory('services')
                                            ->visibility('public')
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                            ->maxSize(2048)
                                            ->helperText('Tải lên hình ảnh (JPEG, PNG, WebP - tối đa 2MB)'),
                                    ]),
                                Tabs\Tab::make('URL')
                                    ->schema([
                                        TextInput::make("{$key}.service_1_image")
                                            ->label('URL hình ảnh')
                                            ->default($services[0]['image'] ?? '')
                                            ->nullable()
                                            ->helperText('VD: https://example.com/image.jpg hoặc /storage/images/service1.jpg'),
                                    ]),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                // Service 2
                Section::make('Dịch vụ 2')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make("{$key}.service_2_title")
                                ->label('Tiêu đề')
                                ->default($services[1]['title'] ?? '')
                                ->required(),
                            TextInput::make("{$key}.service_2_desc")
                                ->label('Mô tả')
                                ->default($services[1]['desc'] ?? ''),
                        ]),

                        Tabs::make('Hình ảnh')
                            ->tabs([
                                Tabs\Tab::make('Upload')
                                    ->schema([
                                        FileUpload::make("{$key}.service_2_upload")
                                            ->label('Upload hình ảnh')
                                            ->image()
                                            ->directory('services')
                                            ->visibility('public')
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                            ->maxSize(2048),
                                    ]),
                                Tabs\Tab::make('URL')
                                    ->schema([
                                        TextInput::make("{$key}.service_2_image")
                                            ->label('URL hình ảnh')
                                            ->default($services[1]['image'] ?? '')
                                            ->nullable(),
                                    ]),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(true),

                // Service 3
                Section::make('Dịch vụ 3')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make("{$key}.service_3_title")
                                ->label('Tiêu đề')
                                ->default($services[2]['title'] ?? '')
                                ->required(),
                            TextInput::make("{$key}.service_3_desc")
                                ->label('Mô tả')
                                ->default($services[2]['desc'] ?? ''),
                        ]),

                        Tabs::make('Hình ảnh')
                            ->tabs([
                                Tabs\Tab::make('Upload')
                                    ->schema([
                                        FileUpload::make("{$key}.service_3_upload")
                                            ->label('Upload hình ảnh')
                                            ->image()
                                            ->directory('services')
                                            ->visibility('public')
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                            ->maxSize(2048),
                                    ]),
                                Tabs\Tab::make('URL')
                                    ->schema([
                                        TextInput::make("{$key}.service_3_image")
                                            ->label('URL hình ảnh')
                                            ->default($services[2]['image'] ?? '')
                                            ->nullable(),
                                    ]),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(true),

                // Service 4
                Section::make('Dịch vụ 4')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make("{$key}.service_4_title")
                                ->label('Tiêu đề')
                                ->default($services[3]['title'] ?? '')
                                ->required(),
                            TextInput::make("{$key}.service_4_desc")
                                ->label('Mô tả')
                                ->default($services[3]['desc'] ?? ''),
                        ]),

                        Tabs::make('Hình ảnh')
                            ->tabs([
                                Tabs\Tab::make('Upload')
                                    ->schema([
                                        FileUpload::make("{$key}.service_4_upload")
                                            ->label('Upload hình ảnh')
                                            ->image()
                                            ->directory('services')
                                            ->visibility('public')
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                            ->maxSize(2048),
                                    ]),
                                Tabs\Tab::make('URL')
                                    ->schema([
                                        TextInput::make("{$key}.service_4_image")
                                            ->label('URL hình ảnh')
                                            ->default($services[3]['image'] ?? '')
                                            ->nullable(),
                                    ]),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(true),
            ])
            ->collapsible()
            ->collapsed(false);
    }

    protected function getStatsCounterBuilder(string $key, $component)
    {
        $stats = $this->getContentValue($component, 'stats', []);

        // Đảm bảo có đủ 4 stats với default values
        $defaultStats = [
            ['number' => '8500', 'label' => 'Khách hàng'],
            ['number' => '150', 'label' => 'Đối tác'],
            ['number' => '1200', 'label' => 'Sản phẩm'],
            ['number' => '63', 'label' => 'Khu vực phân phối'],
        ];

        for ($i = 0; $i < 4; $i++) {
            if (!isset($stats[$i])) {
                $stats[$i] = $defaultStats[$i];
            } else {
                // Merge với default để đảm bảo có đủ fields
                $stats[$i] = array_merge($defaultStats[$i], $stats[$i]);
            }
        }

        return Section::make('4 Thống kê chính (cố định)')
            ->description('Chỉnh sửa 4 số liệu thống kê hiển thị trên trang chủ')
            ->schema([
                // Stat 1
                Grid::make(2)->schema([
                    TextInput::make("{$key}.stat_1_number")
                        ->label('Thống kê 1 - Số liệu')
                        ->default($stats[0]['number'] ?? '')
                        ->required()
                        ->helperText('VD: 8500, 150+, 1.2K'),
                    TextInput::make("{$key}.stat_1_label")
                        ->label('Thống kê 1 - Nhãn')
                        ->default($stats[0]['label'] ?? '')
                        ->required()
                        ->helperText('VD: Khách hàng, Đối tác'),
                ]),

                // Stat 2
                Grid::make(2)->schema([
                    TextInput::make("{$key}.stat_2_number")
                        ->label('Thống kê 2 - Số liệu')
                        ->default($stats[1]['number'] ?? '')
                        ->required(),
                    TextInput::make("{$key}.stat_2_label")
                        ->label('Thống kê 2 - Nhãn')
                        ->default($stats[1]['label'] ?? '')
                        ->required(),
                ]),

                // Stat 3
                Grid::make(2)->schema([
                    TextInput::make("{$key}.stat_3_number")
                        ->label('Thống kê 3 - Số liệu')
                        ->default($stats[2]['number'] ?? '')
                        ->required(),
                    TextInput::make("{$key}.stat_3_label")
                        ->label('Thống kê 3 - Nhãn')
                        ->default($stats[2]['label'] ?? '')
                        ->required(),
                ]),

                // Stat 4
                Grid::make(2)->schema([
                    TextInput::make("{$key}.stat_4_number")
                        ->label('Thống kê 4 - Số liệu')
                        ->default($stats[3]['number'] ?? '')
                        ->required(),
                    TextInput::make("{$key}.stat_4_label")
                        ->label('Thống kê 4 - Nhãn')
                        ->default($stats[3]['label'] ?? '')
                        ->required(),
                ]),
            ])
            ->collapsible()
            ->collapsed(false);
    }

    protected function getFooterBuilder(string $key, $component)
    {
        $policies = $this->getContentValue($component, 'policies', []);
        $copyright = $this->getContentValue($component, 'copyright', '');

        // Đảm bảo có đủ 3 policies với default values
        $defaultPolicies = [
            ['title' => 'CHÍNH SÁCH & ĐIỀU KHOẢN MUA BÁN HÀNG HÓA', 'url' => '/chinh-sach'],
            ['title' => 'HỆ THỐNG ĐẠI LÝ & ĐIỂM BÁN HÀNG', 'url' => '/he-thong-dai-ly'],
            ['title' => 'BẢO MẬT & QUYỀN RIÊNG TƯ', 'url' => '/bao-mat'],
        ];

        for ($i = 0; $i < 3; $i++) {
            if (!isset($policies[$i])) {
                $policies[$i] = $defaultPolicies[$i];
            } else {
                $policies[$i] = array_merge($defaultPolicies[$i], $policies[$i]);
            }
        }

        return Section::make('Nội dung Footer')
            ->description('Chỉnh sửa 3 chính sách và copyright')
            ->schema([
                // 3 Policies cố định
                Grid::make(2)->schema([
                    TextInput::make("{$key}.policy_1_title")
                        ->label('Chính sách 1 - Tiêu đề')
                        ->default($policies[0]['title'] ?? '')
                        ->required(),
                    TextInput::make("{$key}.policy_1_url")
                        ->label('Chính sách 1 - URL')
                        ->default($policies[0]['url'] ?? '')
                        ->nullable()
                        ->helperText('VD: /chinh-sach'),
                ]),

                Grid::make(2)->schema([
                    TextInput::make("{$key}.policy_2_title")
                        ->label('Chính sách 2 - Tiêu đề')
                        ->default($policies[1]['title'] ?? '')
                        ->required(),
                    TextInput::make("{$key}.policy_2_url")
                        ->label('Chính sách 2 - URL')
                        ->default($policies[1]['url'] ?? '')
                        ->nullable(),
                ]),

                Grid::make(2)->schema([
                    TextInput::make("{$key}.policy_3_title")
                        ->label('Chính sách 3 - Tiêu đề')
                        ->default($policies[2]['title'] ?? '')
                        ->required(),
                    TextInput::make("{$key}.policy_3_url")
                        ->label('Chính sách 3 - URL')
                        ->default($policies[2]['url'] ?? '')
                        ->nullable(),
                ]),

                // Copyright
                Textarea::make("{$key}.copyright")
                    ->label('Copyright')
                    ->default($copyright ?: '© ' . date('Y') . ' Copyright by VUPHUC BAKING - All Rights Reserved')
                    ->required()
                    ->rows(2)
                    ->columnSpanFull()
                    ->helperText('VD: © 2025 Copyright by VUPHUC BAKING - All Rights Reserved'),
            ])
            ->collapsible()
            ->collapsed(false);
    }

    protected function getContentBuilder(string $key, $component)
    {
        // Stats Counter chỉ có 4 stats, không có content builder
        if ($key === 'stats-counter') {
            return $this->getStatsCounterBuilder($key, $component);
        }

        // Footer chỉ cần policies và copyright
        if ($key === 'footer') {
            return $this->getFooterBuilder($key, $component);
        }

        return Section::make('Nội dung chi tiết')
            ->schema([
                // Mô tả chính
                Textarea::make("{$key}.content_description")
                    ->label('Mô tả chính')
                    ->default($this->getContentValue($component, 'description'))
                    ->rows(3)
                    ->columnSpanFull(),

                // 4 Dịch vụ/tính năng cố định (cho About Us)
                $key === 'about-us' ? $this->getAboutUsServicesBuilder($key, $component) :
                // Danh sách dịch vụ/tính năng (cho components khác)
                Repeater::make("{$key}.content_services")
                    ->label('Danh sách dịch vụ/tính năng')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('Tiêu đề')
                                ->required(),
                            TextInput::make('desc')
                                ->label('Mô tả'),
                        ]),
                    ])
                    ->defaultItems(0)
                    ->addActionLabel('Thêm dịch vụ/tính năng')
                    ->default($this->getContentValue($component, 'services', []))
                    ->columnSpanFull(),

                // Danh sách tính năng đơn giản
                Repeater::make("{$key}.content_features")
                    ->label('Danh sách tính năng')
                    ->schema([
                        TextInput::make('feature')
                            ->label('Tính năng')
                            ->required(),
                    ])
                    ->defaultItems(0)
                    ->addActionLabel('Thêm tính năng')
                    ->default($this->convertFeaturesToRepeater($this->getContentValue($component, 'features', [])))
                    ->columnSpanFull(),

                // Thống kê cho components khác (không phải stats-counter)
                Repeater::make("{$key}.content_stats")
                    ->label('Thống kê số liệu')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('number')
                                ->label('Số liệu')
                                ->required(),
                            TextInput::make('label')
                                ->label('Nhãn')
                                ->required(),
                        ]),
                    ])
                    ->defaultItems(0)
                    ->addActionLabel('Thêm thống kê')
                    ->default($this->getContentValue($component, 'stats', []))
                    ->columnSpanFull(),
            ])
            ->collapsible()
            ->collapsed();
    }

    protected function getContentValue($component, string $key, $default = null)
    {
        if (!$component || !$component->content) {
            return $default;
        }

        return data_get($component->content, $key, $default);
    }

    protected function convertFeaturesToRepeater(array $features): array
    {
        return array_map(function ($feature) {
            return ['feature' => $feature];
        }, $features);
    }

    protected function buildContentFromForm(array $componentData): ?array
    {
        $content = [];

        // Mô tả chính
        if (!empty($componentData['content_description'])) {
            $content['description'] = $componentData['content_description'];
        }

        // Xử lý 4 services cố định cho About Us
        if (isset($componentData['service_1_title'])) {
            $content['services'] = [];

            for ($i = 1; $i <= 4; $i++) {
                // Ưu tiên upload file, nếu không có thì dùng URL
                $image = '';
                if (!empty($componentData["service_{$i}_upload"])) {
                    // File upload - lấy path từ storage
                    $uploadedFiles = $componentData["service_{$i}_upload"];
                    if (is_array($uploadedFiles) && !empty($uploadedFiles[0])) {
                        $image = '/storage/' . $uploadedFiles[0];
                    }
                } elseif (!empty($componentData["service_{$i}_image"])) {
                    // URL manual
                    $image = $componentData["service_{$i}_image"];
                }

                $content['services'][] = [
                    'title' => $componentData["service_{$i}_title"] ?? '',
                    'desc' => $componentData["service_{$i}_desc"] ?? '',
                    'image' => $image,
                ];
            }
        }
        // Dịch vụ/tính năng cho components khác
        elseif (!empty($componentData['content_services'])) {
            $content['services'] = $componentData['content_services'];
        }

        // Tính năng đơn giản
        if (!empty($componentData['content_features'])) {
            $features = array_map(function ($item) {
                return $item['feature'];
            }, $componentData['content_features']);
            $content['features'] = $features;
        }

        // Xử lý 4 stats cố định cho Stats Counter
        if (isset($componentData['stat_1_number'])) {
            $content['stats'] = [
                [
                    'number' => $componentData['stat_1_number'] ?? '',
                    'label' => $componentData['stat_1_label'] ?? '',
                ],
                [
                    'number' => $componentData['stat_2_number'] ?? '',
                    'label' => $componentData['stat_2_label'] ?? '',
                ],
                [
                    'number' => $componentData['stat_3_number'] ?? '',
                    'label' => $componentData['stat_3_label'] ?? '',
                ],
                [
                    'number' => $componentData['stat_4_number'] ?? '',
                    'label' => $componentData['stat_4_label'] ?? '',
                ],
            ];
        }
        // Thống kê cho components khác
        elseif (!empty($componentData['content_stats'])) {
            $content['stats'] = $componentData['content_stats'];
        }

        // Xử lý Footer - 3 policies và copyright
        if (isset($componentData['policy_1_title'])) {
            $content['policies'] = [
                [
                    'title' => $componentData['policy_1_title'] ?? '',
                    'url' => $componentData['policy_1_url'] ?? '',
                ],
                [
                    'title' => $componentData['policy_2_title'] ?? '',
                    'url' => $componentData['policy_2_url'] ?? '',
                ],
                [
                    'title' => $componentData['policy_3_title'] ?? '',
                    'url' => $componentData['policy_3_url'] ?? '',
                ],
            ];
        }

        if (!empty($componentData['copyright'])) {
            $content['copyright'] = $componentData['copyright'];
        }

        return empty($content) ? null : $content;
    }

    protected function validateFormData(array $data): array
    {
        $errors = [];
        $componentNames = WebDesign::getDefaultComponents();

        foreach ($data as $componentKey => $componentData) {
            $componentName = $componentNames[$componentKey]['component_name'] ?? $componentKey;

            // Validate URLs
            if (!empty($componentData['image_url']) && !$this->isValidUrl($componentData['image_url'])) {
                $errors[] = "Component '{$componentName}': URL hình ảnh không hợp lệ";
            }

            if (!empty($componentData['video_url']) && !$this->isValidUrl($componentData['video_url'])) {
                $errors[] = "Component '{$componentName}': URL video không hợp lệ";
            }

            if (!empty($componentData['button_url']) && !$this->isValidUrl($componentData['button_url'])) {
                $errors[] = "Component '{$componentName}': URL nút bấm không hợp lệ";
            }

            // Validate position
            if (isset($componentData['position']) && (!is_numeric($componentData['position']) || $componentData['position'] < 1)) {
                $errors[] = "Component '{$componentName}': Thứ tự phải là số lớn hơn 0";
            }

            // Validate component name
            if (empty($componentData['component_name'])) {
                $errors[] = "Component '{$componentName}': Tên hiển thị không được để trống";
            }
        }

        return $errors;
    }

    protected function isValidUrl(?string $url): bool
    {
        if (empty($url)) {
            return true; // Empty is valid (nullable)
        }

        // Allow relative URLs starting with /
        if (str_starts_with($url, '/')) {
            return true;
        }

        // Validate full URLs
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    protected function cleanUrl(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        return trim($url);
    }



    public function save(): void
    {
        try {
            // Validate form trước
            $data = $this->form->getState();

            // Custom validation cho URLs
            $errors = $this->validateFormData($data);
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    Notification::make()
                        ->title('❌ Lỗi validation')
                        ->body($error)
                        ->danger()
                        ->send();
                }
                return;
            }

            $webDesignService = app(WebDesignService::class);

            foreach ($data as $componentKey => $componentData) {
                // Build content từ content builder
                $content = $this->buildContentFromForm($componentData);

                $webDesignService->updateOrCreateComponent($componentKey, [
                    'component_name' => $componentData['component_name'] ?? '',
                    'title' => !empty($componentData['title']) ? $componentData['title'] : null,
                    'subtitle' => !empty($componentData['subtitle']) ? $componentData['subtitle'] : null,
                    'content' => $content,
                    'image_url' => $this->cleanUrl($componentData['image_url'] ?? null),
                    'video_url' => $this->cleanUrl($componentData['video_url'] ?? null),
                    'button_text' => !empty($componentData['button_text']) ? $componentData['button_text'] : null,
                    'button_url' => $this->cleanUrl($componentData['button_url'] ?? null),
                    'position' => $componentData['position'] ?? 1,
                    'is_active' => $componentData['is_active'] ?? true,
                    'settings' => $componentData['settings'] ?? [],
                ]);
            }

            // Reload data sau khi save
            $this->loadWebDesignData();

            Notification::make()
                ->title('✅ Đã lưu thành công')
                ->body('Tất cả thay đổi đã được áp dụng')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('❌ Lỗi khi lưu')
                ->body('Có lỗi xảy ra: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Lưu cấu hình')
                ->action('save')
                ->color('success'),

            Action::make('export')
                ->label('Xuất cấu hình')
                ->action('exportConfig')
                ->color('info')
                ->icon('heroicon-o-arrow-down-tray'),

            Action::make('reset')
                ->label('Khôi phục mặc định')
                ->action('resetToDefault')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Khôi phục cấu hình mặc định')
                ->modalDescription('Bạn có chắc chắn muốn khôi phục tất cả cấu hình về mặc định? Hành động này không thể hoàn tác.')
                ->modalSubmitActionLabel('Khôi phục'),
        ];
    }

    public function resetToDefault(): void
    {
        $webDesignService = app(WebDesignService::class);
        $webDesignService->resetToDefault();
        $this->loadWebDesignData();

        Notification::make()
            ->title('Đã khôi phục cấu hình mặc định')
            ->success()
            ->send();
    }

    public function exportConfig()
    {
        $webDesignService = app(WebDesignService::class);
        $sections = $webDesignService->getAllSections();

        $exportData = [
            'version' => '1.0',
            'exported_at' => now()->toISOString(),
            'exported_by' => auth()->user()->name ?? 'System',
            'sections' => $sections,
        ];

        $fileName = 'webdesign-config-' . now()->format('Y-m-d-H-i-s') . '.json';
        $content = json_encode($exportData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // Tạo response download
        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $fileName, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}
