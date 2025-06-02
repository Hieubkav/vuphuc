# Vũ Phúc - Website Doanh Nghiệp

Dự án website doanh nghiệp được xây dựng bằng Laravel 10 với Filament Admin Panel, tích hợp Livewire và Tailwind CSS.

## 🚀 Tính năng chính

- **Admin Panel**: Quản trị toàn diện với Filament
- **Responsive Design**: Giao diện tối ưu cho mọi thiết bị
- **SEO Optimized**: Tối ưu hóa SEO tự động
- **Real-time Updates**: Cập nhật thời gian thực với Livewire
- **QR Code Integration**: Tích hợp mã QR cho nhân viên
- **Image Optimization**: Tự động chuyển đổi ảnh sang WebP

## 📋 Yêu cầu hệ thống

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Laravel 10.x

## 🛠️ Cài đặt

```bash
# Clone repository
git clone [repository-url]
cd vuphuc

# Cài đặt dependencies
composer install --ignore-platform-reqs
npm install

# Cấu hình môi trường
cp .env.example .env
php artisan key:generate

# Chạy migration
php artisan migrate --seed

# Build assets
npm run build

# Tối ưu hóa
php artisan icons:cache
php artisan filament:optimize
php artisan optimize

# Khởi động server
php artisan serve
```

## 📚 Tài liệu

Xem thêm tài liệu chi tiết trong thư mục `/docs`:

- [Hướng dẫn cài đặt](docs/installation.md)
- [Hướng dẫn phát triển](docs/development.md)
- [Hướng dẫn triển khai](docs/deployment.md)
- [Tài liệu API](docs/api.md)

## 🏗️ Cấu trúc dự án

```
vuphuc/
├── app/                    # Mã nguồn ứng dụng
├── docs/                   # Tài liệu dự án
├── public/                 # Assets công khai
├── resources/              # Views, CSS, JS
├── storage/                # File lưu trữ
└── tests/                  # Test cases
```

## 🤝 Đóng góp

Vui lòng đọc [CONTRIBUTING.md](docs/CONTRIBUTING.md) để biết thêm chi tiết.

## 📄 License

Dự án này được cấp phép theo MIT License.
