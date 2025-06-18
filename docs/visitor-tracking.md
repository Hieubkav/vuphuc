# Hệ thống Tracking Lượt Truy Cập Website

## Tổng quan
Hệ thống tracking lượt truy cập được tích hợp vào website để theo dõi:
- Lượt truy cập website tổng thể
- Lượt xem từng bài viết cụ thể  
- Lượt xem từng sản phẩm cụ thể
- Thống kê người dùng khác nhau (unique visitors)

## Các thành phần chính

### 1. Models
- **Visitor**: Lưu thông tin lượt truy cập website
- **PostView**: Tracking lượt xem bài viết
- **ProductView**: Tracking lượt xem sản phẩm

### 2. Middleware
- **TrackVisitor**: Tự động tracking mọi request GET (trừ admin)

### 3. Dashboard Widgets
- **VisitorStatsWidget**: Thống kê lượt truy cập hôm nay và tổng
- **TopContentWidget**: Top bài viết và sản phẩm được xem nhiều nhất

### 4. Admin Page
- **VisitorAnalytics**: Trang quản lý và phân tích tracking với nút reset

## Cách sử dụng

### Xem thống kê
1. Truy cập `/admin/dashboard` để xem widget trên dashboard chính
2. Truy cập `/admin/visitor-analytics` để xem chi tiết và quản lý

### Reset dữ liệu
**Từ Admin Panel:**
- Vào trang "Phân tích truy cập" 
- Sử dụng các nút reset ở góc trên bên phải

**Từ Command Line:**
```bash
# Reset tất cả dữ liệu
php artisan visitor:reset

# Reset chỉ dữ liệu truy cập website
php artisan visitor:reset --type=visitors

# Reset chỉ dữ liệu xem nội dung
php artisan visitor:reset --type=content
```

## Cách hoạt động

### Tracking tự động
- Middleware `TrackVisitor` được đăng ký trong `web` middleware group
- Tự động ghi nhận mọi request GET không phải admin
- Tracking theo IP address và session ID
- Tránh duplicate trong 24h cho cùng IP xem cùng nội dung

### Dữ liệu được thu thập
**Visitor:**
- IP address, User Agent, Session ID
- URL được truy cập, Referer
- Thời gian truy cập

**PostView/ProductView:**
- ID của bài viết/sản phẩm
- IP address, Session ID  
- Thời gian xem

## Tính năng nổi bật

### 1. Thống kê realtime
- Tất cả widget tự động refresh mỗi 5 giây
- Hiển thị dữ liệu hôm nay vs hôm qua
- Biểu đồ lượt truy cập theo giờ
- Bao gồm cả top sản phẩm và bài viết được xem nhiều nhất

### 2. Top content
- Top 3 bài viết được xem nhiều nhất
- Top 3 sản phẩm được xem nhiều nhất
- Hiển thị cả tổng lượt xem và số người xem khác nhau

### 3. Quản lý dữ liệu
- Reset từng loại dữ liệu riêng biệt
- Reset tất cả với xác nhận
- Command line support cho automation

## Lưu ý kỹ thuật

### Performance
- Sử dụng index database cho truy vấn nhanh
- Middleware chỉ chạy cho GET request
- Tránh tracking admin panel

### Privacy
- Chỉ lưu IP address, không lưu thông tin cá nhân
- Có thể dễ dàng xóa dữ liệu khi cần

### Customization
- Có thể thay đổi thời gian duplicate detection
- Có thể thêm tracking cho các loại content khác
- Có thể tùy chỉnh widget hiển thị
