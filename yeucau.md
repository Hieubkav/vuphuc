# NỘI DUNG YÊU CẦU CHỨC NĂNG PHẦN MỀM

## I. Phạm vi triển khai 
- Nâng cấp Website của Công ty TNHH SXTMDV Vũ Phúc (https://vuphucbaking.com/).
- Ngôn ngữ sử dụng: Tiếng Việt.
- Website được cài đặt trên máy chủ được chỉ định của bên công ty Vũ Phúc.

## II. Nội dung chức năng 

### 1. Các module chính của Website:

| STT | Các module của Website | Mô tả tổng quát |
|-----|------------------------|-----------------|
| 1   | 1. Trang chủ<br>2. Giới thiệu sản phẩm<br>3. Giới thiệu dịch vụ | - Giao diện đơn giản, thân thiện với người dùng, có thể xây dựng giao diện mới dựa trên nền tảng giao diện trạng web hiện tại (vuphucbaking.com)<br>- Mục tiêu trang web là giới thiệu về các dịch vụ của công ty: Sản phẩm (bánh, nguyên liệu làm bánh, sản phẩm tải rửa, khóa học làm bánh,...), dịch vụ giao hàng, hoạt động của công ty. |

### 2. Mô tả chức năng chính của từng module:

#### Trang chủ
- **Giới thiệu về công ty**: 
  - Mục tiêu làm nổi bật phần giới thiệu thương hiệu "VŨ PHÚC BAKING – Vì sự phát triển"
  - Thể hiện giá trị, sứ mệnh và uy tín của doanh nghiệp

- **Giới thiệu thông tin dịch vụ**:
  - **Thông tin giao hàng**: Hiển thị tuyến giao hàng định kỳ
  - **Thông tin sản phẩm nổi bật**: Sản phẩm khuyến mãi và nổi bật 

- **Hoạt động công ty**: 
  - Trình bày lại phần tin tức, hoạt động nội bộ
  - Thông tin khuyến mãi, khóa học

- **Các yếu tố bổ trợ khác**:
  - Đối tác tin cậy 
  - Footer

#### Trang giới thiệu sản phẩm
- **Đồng bộ sản phẩm**: 
  - Từ hệ thống Eshop thông qua API (Khách hàng cung cấp)
  - API URL: https://openplatform.mshopkeeper.vn/articles/index.html

- **Chức năng hiển thị sản phẩm**:
  - Hiển thị danh sách sản phẩm
  - Hiển thị chi tiết sản phẩm
  - Chức năng ẩn/hiện sản phẩm

#### Trang giới thiệu dịch vụ
- **Hiển thị danh sách các khóa học làm bánh**:
  - **Thêm nội dung khóa học**: 
    - Cột mốc từng thời gian khóa học (khai giảng, đang học, kết thúc khóa học)
    - Nội dung mô tả, hình ảnh theo từng mốc thời gian
  - **Xem chi tiết khóa học**
  - **Chức năng đăng ký khóa học**: 
    - Khi người dùng nhấn đăng ký sẽ link đến trang Google Form

- **Hiển thị các bài viết giới thiệu**:
  - Thêm bài viết
  - Xem chi tiết bài viết