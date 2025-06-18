# 🎨 Hệ thống WebDesign - Cấu hình giao diện động

## 📋 Tổng quan

Hệ thống WebDesign cho phép quản trị viên tùy chỉnh việc hiển thị và thứ tự các section trong trang chủ StoreFront một cách động thông qua giao diện Filament Admin.

## 🏗️ Kiến trúc hệ thống

### Models
- **WebDesign** (`app/Models/WebDesign.php`): Model chính quản lý cấu hình sections

### Services  
- **WebDesignService** (`app/Services/WebDesignService.php`): Service xử lý logic và cache

### Controllers
- **WebDesignController** (`app/Http/Controllers/Api/WebDesignController.php`): API endpoints

### Filament Pages
- **ManageWebDesign** (`app/Filament/Admin/Pages/ManageWebDesign.php`): Giao diện quản lý

### Helper Functions
- **WebDesignHelper** (`app/Helpers/WebDesignHelper.php`): Helper functions toàn cục

## 🎛️ Các section có thể cấu hình

| Section Key | Tên hiển thị | Mô tả | Thứ tự mặc định |
|-------------|--------------|-------|-----------------|
| `hero-banner` | Hero Banner | Banner chính trang chủ | 1 |
| `about-us` | Giới thiệu | Phần giới thiệu về công ty | 2 |
| `stats-counter` | Thống kê | Bộ đếm thống kê | 3 |
| `featured-products` | Sản phẩm nổi bật | Danh sách sản phẩm nổi bật | 4 |
| `services` | Dịch vụ | Các dịch vụ của công ty | 5 |
| `slogan` | Slogan | Khẩu hiệu công ty | 6 |
| `courses-overview` | Tổng quan khóa học | Giới thiệu các khóa học | 7 |
| `partners` | Đối tác | Danh sách đối tác | 8 |
| `blog-posts` | Bài viết | Bài viết mới nhất | 9 |
| `footer` | Footer | Chân trang website | 10 |

## 🔧 Helper Functions

### `webDesignVisible(string $sectionKey): bool`
Kiểm tra xem một section có được hiển thị không.

```php
@if(webDesignVisible('hero-banner'))
    <section id="hero-banner">
        @include('components.storefront.hero-banner')
    </section>
@endif
```

### `webDesignSettings(string $sectionKey, ?string $key = null, $default = null)`
Lấy cấu hình settings của một section.

```php
$limit = webDesignSettings('featured-products', 'limit', 8);
$showPrice = webDesignSettings('featured-products', 'show_price', true);
```

### `webDesignOrder(string $sectionKey): int`
Lấy thứ tự hiển thị của một section.

```php
$order = webDesignOrder('hero-banner'); // Returns: 1
```

### `getVisibleWebDesignSections(): array`
Lấy tất cả sections hiển thị theo thứ tự.

```php
$sections = getVisibleWebDesignSections();
foreach($sections as $sectionKey => $config) {
    // Render section
}
```

## 🚀 Artisan Commands

### Reset cấu hình về mặc định
```bash
php artisan webdesign:reset
php artisan webdesign:reset --force  # Không hỏi xác nhận
```

### Đồng bộ sections
```bash
php artisan webdesign:sync          # Thực hiện đồng bộ
php artisan webdesign:sync --check  # Chỉ kiểm tra
```

## 🌐 API Endpoints

### GET `/api/webdesign`
Lấy tất cả cấu hình WebDesign.

### GET `/api/webdesign/visible`  
Lấy các sections hiển thị theo thứ tự.

### GET `/api/webdesign/{sectionKey}`
Lấy cấu hình của một section cụ thể.

### GET `/api/webdesign/export`
Export cấu hình WebDesign.

### POST `/api/webdesign/clear-cache` (Auth required)
Clear cache WebDesign.

### POST `/api/webdesign/reset` (Auth required)
Reset về cấu hình mặc định.

## 💾 Cache System

Hệ thống sử dụng cache để tối ưu hiệu suất:
- **Cache Key**: `web_design_sections`
- **TTL**: 1 giờ (3600 giây)
- **Auto Clear**: Khi có thay đổi trong database

## 🎯 Cách sử dụng

### 1. Quản lý qua Filament Admin
- Truy cập: `/admin/manage-web-design`
- Bật/tắt sections
- Sắp xếp thứ tự
- Cấu hình chi tiết
- Export/Import config

### 2. Sử dụng trong Views
```php
{{-- Cách 1: Sử dụng helper functions --}}
@if(webDesignVisible('hero-banner'))
    <section id="hero-banner">
        @include('components.storefront.hero-banner')
    </section>
@endif

{{-- Cách 2: Sử dụng dynamic component --}}
@include('components.dynamic-storefront')
```

### 3. Sử dụng trong Controllers
```php
use App\Services\WebDesignService;

$webDesignService = app(WebDesignService::class);
$isVisible = $webDesignService->isVisible('hero-banner');
$settings = $webDesignService->getSettings('featured-products');
```

## 🔒 Bảo mật

- API endpoints có authentication cho các action nguy hiểm
- Validation đầy đủ cho form inputs
- Cache được clear tự động khi có thay đổi

## 🐛 Troubleshooting

### Cache không được clear
```bash
php artisan cache:clear
php artisan webdesign:sync
```

### Sections bị thiếu
```bash
php artisan webdesign:sync --check
php artisan webdesign:sync
```

### Reset toàn bộ
```bash
php artisan webdesign:reset --force
```

## 📈 Performance Tips

1. Sử dụng cache warming cho trang chủ
2. Minimize số lượng sections hiển thị
3. Sử dụng `getVisibleWebDesignSections()` thay vì check từng section
4. Enable middleware cache cho storefront routes
