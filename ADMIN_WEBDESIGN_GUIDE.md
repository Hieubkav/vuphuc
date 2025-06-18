# 🎨 Hướng dẫn sử dụng trang Quản lý nội dung

## 📍 Truy cập
- **URL**: `/admin/manage-web-design`
- **Menu**: Admin Panel → 🎨 Quản lý Website → Cấu hình giao diện

## 🎯 Tính năng chính

### 1. **Quản lý hiển thị**
- ✅ **Bật/tắt component**: Toggle "🔍 Hiển thị" để ẩn/hiện component
- 📍 **Sắp xếp thứ tự**: Thay đổi số thứ tự (1, 2, 3...) để sắp xếp
- 🏷️ **Đổi tên**: Chỉnh sửa tên hiển thị của component

### 2. **Chỉnh sửa nội dung**
- 📝 **Tiêu đề chính**: Title hiển thị lớn nhất
- 📄 **Tiêu đề phụ**: Subtitle hoặc tagline
- 🖼️ **Hình ảnh**: URL link đến hình ảnh
- 🎥 **Video**: URL link đến video
- 🔘 **Nút bấm**: Text và URL cho button

### 3. **Nội dung JSON**
Dùng để lưu dữ liệu phức tạp:

```json
{
  "description": "Mô tả chi tiết về component",
  "services": [
    {
      "title": "Dịch vụ 1",
      "desc": "Mô tả dịch vụ 1"
    },
    {
      "title": "Dịch vụ 2", 
      "desc": "Mô tả dịch vụ 2"
    }
  ],
  "features": ["Tính năng 1", "Tính năng 2", "Tính năng 3"]
}
```

## 🚀 Cách sử dụng

### Bước 1: Chọn component
- Mở rộng component muốn chỉnh sửa
- Component "Giới thiệu" mở sẵn để dễ test

### Bước 2: Chỉnh sửa
- **Cấu hình cơ bản**: Bật/tắt, thứ tự, tên
- **Nội dung chính**: Tiêu đề, phụ đề
- **Media**: Hình ảnh, video URLs
- **Nút bấm**: Text và link
- **JSON**: Nội dung phức tạp

### Bước 3: Lưu
- Click nút "Lưu cấu hình" ở header
- Thông báo xanh = thành công
- Thông báo đỏ = có lỗi (kiểm tra JSON)

### Bước 4: Xem kết quả
- Click "👁️ Xem trang chủ" để mở tab mới
- Refresh trang để thấy thay đổi

## ⚠️ Lưu ý quan trọng

### JSON Format
- **Đúng**: `{"key": "value", "array": ["item1", "item2"]}`
- **Sai**: `{key: value}` (thiếu dấu ngoặc kép)
- **Sai**: `{"key": "value",}` (dấu phẩy thừa)

### Thứ tự hiển thị
- Số nhỏ hơn hiển thị trước: 1 → 2 → 3
- Có thể dùng số thập phân: 1.5, 2.5
- Tránh trùng số để tránh conflict

### URLs
- **Hình ảnh**: `/storage/images/banner.jpg` hoặc `https://example.com/image.jpg`
- **Video**: `https://youtube.com/watch?v=...` hoặc `/storage/videos/intro.mp4`
- **Links**: `/about-us`, `/products`, `https://external-site.com`

## 🔧 Troubleshooting

### Lỗi JSON
```
❌ Lỗi JSON trong component about-us
```
**Giải pháp**: Kiểm tra syntax JSON, dùng tool validate JSON online

### Component không hiển thị
1. Kiểm tra toggle "🔍 Hiển thị" = ON
2. Kiểm tra thứ tự không bị âm
3. Clear cache browser (Ctrl+F5)

### Thay đổi không có hiệu lực
1. Đảm bảo đã click "Lưu cấu hình"
2. Refresh trang chủ (F5)
3. Kiểm tra cache server

## 📊 Thống kê

Phần "📊 Thống kê nhanh" hiển thị:
- ✅ **Components hiển thị**: Số component đang bật
- ❌ **Components ẩn**: Số component đang tắt  
- 📝 **Có tiêu đề**: Số component có title
- 🎯 **Tổng components**: Tổng số component

---

**💡 Tip**: Bắt đầu với component "Giới thiệu" để làm quen, sau đó chỉnh sửa các component khác!
