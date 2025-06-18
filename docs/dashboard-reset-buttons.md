# Nút Reset Tracking trong Dashboard

## Tổng quan
Dashboard đã được tích hợp 4 nút reset để quản lý dữ liệu tracking một cách dễ dàng và thuận tiện cho việc test.

## Vị trí các nút
Các nút reset được tích hợp trong **Widget "Bảng Điều Khiển Tracking"** ở đầu dashboard, dễ dàng truy cập và sử dụng.

## Danh sách các nút

### 🌐 Reset Lượt Truy Cập
- **Màu**: Warning (Vàng)
- **Chức năng**: Xóa tất cả dữ liệu tracking lượt truy cập website
- **Bảng ảnh hưởng**: `visitors`
- **Sử dụng khi**: Muốn test lại từ đầu việc tracking lượt truy cập website

### 📄 Reset Lượt Xem Nội Dung  
- **Màu**: Info (Xanh dương)
- **Chức năng**: Xóa tất cả dữ liệu tracking lượt xem bài viết và sản phẩm
- **Bảng ảnh hưởng**: `post_views`, `product_views`
- **Sử dụng khi**: Muốn test lại việc tracking lượt xem nội dung

### 🗑️ Reset Tất Cả
- **Màu**: Danger (Đỏ)
- **Chức năng**: Xóa TẤT CẢ dữ liệu tracking
- **Bảng ảnh hưởng**: `visitors`, `post_views`, `product_views`
- **Sử dụng khi**: Muốn reset hoàn toàn hệ thống tracking

### 🧪 Tạo Dữ Liệu Test
- **Màu**: Success (Xanh lá)
- **Chức năng**: Tạo 30 bản ghi dữ liệu test ngẫu nhiên
- **Sử dụng khi**: Muốn có dữ liệu mẫu để test các widget

## Tính năng bảo mật

### Xác nhận trước khi thực hiện
- Tất cả các nút đều yêu cầu **xác nhận** trước khi thực hiện
- Sử dụng `wire:confirm` để hiển thị cảnh báo rõ ràng
- Có thể hủy bỏ nếu không muốn thực hiện

### Thông báo kết quả
- Hiển thị notification thành công sau khi hoàn thành
- Thông báo kéo dài 5 giây với icon và màu sắc phù hợp
- Mô tả chi tiết về những gì đã được thực hiện

## Widget Tracking Control

### Hiển thị thống kê realtime
- **Lượt truy cập**: Tổng cộng và hôm nay
- **Lượt xem bài viết**: Tổng cộng và hôm nay  
- **Lượt xem sản phẩm**: Tổng cộng và hôm nay

### Auto-refresh
- Widget tự động cập nhật mỗi 5 giây
- Hiển thị dữ liệu realtime

### Hướng dẫn sử dụng
- Tích hợp hướng dẫn ngay trong widget
- Giải thích ý nghĩa từng nút reset

## Workflow test thông thường

### 1. Reset dữ liệu cũ
```
Bước 1: Nhấn "Reset Tất Cả" để xóa dữ liệu cũ
Bước 2: Xác nhận trong modal popup
Bước 3: Chờ notification thành công
```

### 2. Tạo dữ liệu test
```
Bước 1: Nhấn "Tạo Dữ Liệu Test"
Bước 2: Xác nhận tạo 30 bản ghi test
Bước 3: Quan sát các widget cập nhật dữ liệu
```

### 3. Test tracking thực tế
```
Bước 1: Truy cập website frontend
Bước 2: Xem các bài viết và sản phẩm
Bước 3: Quay lại dashboard xem dữ liệu realtime
```

## Command Line Alternative

Ngoài các nút trong dashboard, bạn cũng có thể sử dụng command line:

```bash
# Reset tất cả
php artisan visitor:reset

# Reset chỉ lượt truy cập
php artisan visitor:reset --type=visitors

# Reset chỉ lượt xem nội dung
php artisan visitor:reset --type=content

# Tạo dữ liệu test
php artisan visitor:generate-test-data --count=50
```

## Lưu ý quan trọng

⚠️ **Cảnh báo**: Tất cả các thao tác reset đều **KHÔNG THỂ HOÀN TÁC**

✅ **Best Practice**: Luôn backup dữ liệu quan trọng trước khi reset

🔄 **Auto-refresh**: Sau khi reset, các widget sẽ tự động cập nhật trong vòng 5 giây
