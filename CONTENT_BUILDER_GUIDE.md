# 🎨 Content Builder - Hướng dẫn cho Admin

## 📍 Truy cập
- **URL**: `/admin/manage-web-design`
- **Menu**: Admin Panel → 🎨 Quản lý Website → Cấu hình giao diện

## 🎯 Giao diện mới - Đơn giản & Dễ sử dụng

### ✅ **Đã loại bỏ:**
- ❌ Phần "Xem trang chủ" (đã có ở thanh trên)
- ❌ Thống kê không cần thiết
- ❌ Hướng dẫn sử dụng dài dòng
- ❌ JSON phức tạp khó hiểu

### ✅ **Thay thế bằng:**
- ✅ **Content Builder** - Giao diện trực quan
- ✅ **Form đơn giản** - Không cần biết JSON
- ✅ **Dark mode** - Màu chữ rõ ràng
- ✅ **Minimalist** - Tập trung vào nội dung

## 🛠️ Content Builder

### 1. **Thông tin cơ bản**
```
├─ Hiển thị: ON/OFF
├─ Thứ tự: 1, 2, 3...
└─ Tên hiển thị: "Giới thiệu", "Dịch vụ"...
```

### 2. **Nội dung chính**
```
├─ Tiêu đề chính: "Chào mừng đến với..."
├─ Tiêu đề phụ: "VỀ CHÚNG TÔI"
├─ URL Hình ảnh: /storage/images/...
├─ URL Video: https://youtube.com/...
├─ Text nút bấm: "Tìm hiểu thêm"
└─ URL nút bấm: /gioi-thieu
```

### 3. **Nội dung chi tiết** (Content Builder)

#### 📝 **Mô tả chính**
```
Textarea đơn giản để nhập mô tả
VD: "Lấy người tiêu dùng làm trọng tâm..."
```

#### 🔧 **Danh sách dịch vụ/tính năng**
```
[+ Thêm dịch vụ/tính năng]

Dịch vụ 1:
├─ Tiêu đề: "Bánh Ngọt Cao Cấp"
└─ Mô tả: "Sản phẩm chất lượng từ nguyên liệu tự nhiên"

Dịch vụ 2:
├─ Tiêu đề: "Quy Trình Chuẩn"
└─ Mô tả: "Kiểm soát chất lượng nghiêm ngặt"
```

#### ⭐ **Danh sách tính năng**
```
[+ Thêm tính năng]

Tính năng 1: "Chất lượng cao"
Tính năng 2: "Giá cả hợp lý"
Tính năng 3: "Hỗ trợ kỹ thuật"
```

#### 📊 **Thống kê số liệu** (chỉ cho Stats Counter)
```
[+ Thêm thống kê]

Thống kê 1:
├─ Số liệu: "500+"
└─ Nhãn: "Khách hàng tin tưởng"

Thống kê 2:
├─ Số liệu: "1000+"
└─ Nhãn: "Sản phẩm chất lượng"
```

## 🚀 Cách sử dụng

### Bước 1: Chọn component
- Click vào component muốn chỉnh sửa
- VD: "Giới thiệu" đã mở sẵn

### Bước 2: Chỉnh sửa cơ bản
- **Hiển thị**: Bật/tắt component
- **Thứ tự**: Nhập số (1, 2, 3...)
- **Tên**: Đổi tên hiển thị

### Bước 3: Chỉnh sửa nội dung
- **Tiêu đề**: Nhập tiêu đề chính/phụ
- **Media**: Paste URL hình ảnh/video
- **Button**: Nhập text và link

### Bước 4: Content Builder
- **Mô tả**: Nhập văn bản mô tả
- **Dịch vụ**: Click "Thêm dịch vụ" → Nhập tiêu đề + mô tả
- **Tính năng**: Click "Thêm tính năng" → Nhập tên tính năng
- **Thống kê**: (Chỉ Stats) Click "Thêm thống kê" → Nhập số + nhãn

### Bước 5: Lưu
- Click "Lưu cấu hình"
- Thông báo xanh = thành công

## 💡 Ví dụ thực tế

### Component "Giới thiệu":
```
Tiêu đề chính: "Chào mừng đến với Vuphuc Baking®"
Tiêu đề phụ: "VỀ CHÚNG TÔI"

Mô tả chính:
"Lấy người tiêu dùng làm trọng tâm cho mọi hoạt động..."

Dịch vụ 1:
- Tiêu đề: "Bánh Ngọt Cao Cấp"
- Mô tả: "Sản phẩm chất lượng từ nguyên liệu tự nhiên"

Dịch vụ 2:
- Tiêu đề: "Quy Trình Chuẩn"  
- Mô tả: "Kiểm soát chất lượng nghiêm ngặt"

Button:
- Text: "Tìm hiểu thêm về chúng tôi"
- URL: "/gioi-thieu"
```

## ⚠️ Lưu ý

- **Không cần biết JSON** - Chỉ cần điền form
- **Thêm/xóa dễ dàng** - Click nút [+] hoặc [x]
- **Tự động lưu** - Dữ liệu được convert thành JSON tự động
- **Dark mode** - Màu chữ rõ ràng trong cả 2 theme

---

**🎉 Giờ đây admin có thể chỉnh sửa nội dung mà không cần biết code!**
