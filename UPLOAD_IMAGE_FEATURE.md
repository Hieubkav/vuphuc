# 📸 Upload Image Feature - Bỏ URL Media không cần thiết

## ✅ Đã sửa lại

### 🚫 **Trước đây:**
- URL Hình ảnh và URL Video ở phần chung (không dùng)
- Chỉ có thể nhập URL manual cho services
- Không thể upload file trực tiếp
- Form dài dòng với fields không cần thiết

### ✅ **Bây giờ:**
- ❌ **Bỏ hoàn toàn**: URL Hình ảnh và URL Video chung
- ✅ **Upload + URL**: Cho từng service riêng biệt
- ✅ **Tabs interface**: Upload hoặc URL
- ✅ **Auto storage**: File tự động lưu vào `/storage/services/`

## 🎨 **Giao diện mới**

### About Us - 4 Services:
```
🎯 Giới thiệu
├─ Hiển thị: [ON/OFF]
├─ Thứ tự: [2]
├─ Tên hiển thị: "Giới thiệu"
├─ Tiêu đề chính: "Chào mừng..."
├─ Tiêu đề phụ: "VỀ CHÚNG TÔI"
├─ Mô tả chính: [Textarea...]
└─ 4 Dịch vụ chính (cố định)
    └─ Dịch vụ 1 ▼
        ├─ Tiêu đề: "Bánh Ngọt Cao Cấp"
        ├─ Mô tả: "Sản phẩm chất lượng..."
        └─ Hình ảnh:
            ├─ [Tab] Upload
            │   └─ [📁 Chọn file] (JPEG, PNG, WebP - max 2MB)
            └─ [Tab] URL
                └─ URL hình ảnh: "https://example.com/image.jpg"
    └─ Dịch vụ 2 ▼ (collapsed)
    └─ Dịch vụ 3 ▼ (collapsed)  
    └─ Dịch vụ 4 ▼ (collapsed)
```

### Other Components:
```
🎯 Services / Stats Counter / etc.
├─ Hiển thị: [ON/OFF]
├─ Thứ tự: [3]
├─ Tên hiển thị: "Dịch vụ"
├─ Tiêu đề chính: [...]
├─ Tiêu đề phụ: [...]
├─ Text nút bấm: [...]
├─ URL nút bấm: [...]
└─ [Content Builder...]
```

## 🔧 **Technical Implementation**

### FileUpload Configuration:
```php
FileUpload::make("{$key}.service_1_upload")
    ->label('Upload hình ảnh')
    ->image()
    ->directory('services')           // Lưu vào /storage/app/public/services/
    ->visibility('public')           // Public access
    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
    ->maxSize(2048)                  // 2MB max
```

### Tabs Interface:
```php
Tabs::make('Hình ảnh')
    ->tabs([
        Tabs\Tab::make('Upload')     // Tab 1: Upload file
            ->schema([FileUpload::make(...)]),
        Tabs\Tab::make('URL')        // Tab 2: Manual URL
            ->schema([TextInput::make(...)]),
    ])
```

### Data Processing:
```php
// Save: Ưu tiên upload, fallback URL
$image = '';
if (!empty($componentData["service_{$i}_upload"])) {
    $uploadedFiles = $componentData["service_{$i}_upload"];
    $image = '/storage/' . $uploadedFiles[0];  // /storage/services/filename.jpg
} elseif (!empty($componentData["service_{$i}_image"])) {
    $image = $componentData["service_{$i}_image"];  // Manual URL
}

// Load: Detect uploaded vs URL
if ($image && str_starts_with($image, '/storage/')) {
    // Uploaded file
    $this->data[$key]["service_{$i}_upload"] = [str_replace('/storage/', '', $image)];
    $this->data[$key]["service_{$i}_image"] = '';
} else {
    // Manual URL
    $this->data[$key]["service_{$i}_upload"] = [];
    $this->data[$key]["service_{$i}_image"] = $image;
}
```

## 📁 **File Structure**

### Storage Directory:
```
storage/
└── app/
    └── public/
        └── services/           # Service images
            ├── abc123.jpg      # Auto-generated names
            ├── def456.png
            └── ghi789.webp

public/
└── storage/                   # Symlink
    └── services/              # Public access
        ├── abc123.jpg         # → /storage/services/abc123.jpg
        ├── def456.png
        └── ghi789.webp
```

### Database JSON:
```json
{
  "services": [
    {
      "title": "Bánh Ngọt Cao Cấp",
      "desc": "Sản phẩm chất lượng...",
      "image": "/storage/services/abc123.jpg"    // Uploaded file
    },
    {
      "title": "Quy Trình Chuẩn",
      "desc": "Kiểm soát chất lượng...",
      "image": "https://example.com/image.jpg"   // External URL
    },
    {
      "title": "Đào Tạo Chuyên Nghiệp", 
      "desc": "Hỗ trợ kỹ thuật...",
      "image": ""                                // No image
    },
    {
      "title": "Đội Ngũ Chuyên Gia",
      "desc": "Kinh nghiệm nhiều năm...",
      "image": "/storage/services/def456.png"   // Uploaded file
    }
  ]
}
```

## 🚀 **User Experience**

### Upload Workflow:
```
1. Admin click "Dịch vụ 1" để mở
2. Click tab "Upload"
3. Drag & drop hoặc click chọn file
4. File tự động upload → /storage/services/
5. Preview hiển thị ngay
6. Click "Lưu cấu hình"
7. Image hiển thị trên frontend
```

### URL Workflow:
```
1. Admin click "Dịch vụ 2" để mở
2. Click tab "URL"
3. Paste link: "https://example.com/image.jpg"
4. Click "Lưu cấu hình"
5. Image hiển thị trên frontend
```

## 🎯 **Benefits**

### 1. **Simplified Interface**
- ✅ Bỏ fields không cần thiết
- ✅ Focus vào content thực sự cần
- ✅ Clean form, dễ sử dụng

### 2. **Flexible Image Management**
- ✅ Upload local files
- ✅ Use external URLs
- ✅ Auto file management
- ✅ Preview functionality

### 3. **Better Organization**
- ✅ Mỗi service có hình riêng
- ✅ Collapsible sections
- ✅ Tab interface intuitive

### 4. **Performance**
- ✅ Optimized file storage
- ✅ Public access via symlink
- ✅ Accepted formats: JPEG, PNG, WebP
- ✅ Size limit: 2MB

---

**🎉 Giờ đây admin có thể upload hình ảnh trực tiếp hoặc dùng URL, không còn fields thừa!**
