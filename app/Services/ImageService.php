<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Lưu hình ảnh tải lên với định dạng WebP và tối ưu hóa
     *
     * @param UploadedFile|string $image Ảnh tải lên hoặc đường dẫn ảnh
     * @param string $directory Thư mục lưu trong storage
     * @param int $width Chiều rộng (0 để giữ nguyên)
     * @param int $height Chiều cao (0 để giữ nguyên)
     * @param int $quality Chất lượng ảnh (1-100)
     * @return string|null Đường dẫn đến ảnh đã lưu
     */
    public function saveImage($image, string $directory, int $width = 0, int $height = 0, int $quality = 80): ?string
    {
        // Nếu không có ảnh, trả về null
        if (!$image) {
            return null;
        }

        // Khởi tạo ImageManager với driver GD
        $manager = new ImageManager(new Driver());

        // Nếu là UploadedFile (file mới upload)
        if ($image instanceof UploadedFile) {
            // Tạo tên file mới với định dạng webp
            $filename = Str::random(20) . '.webp';
            
            // Đọc hình ảnh từ file tạm
            $img = $manager->read($image->getRealPath());
            
            // Resize nếu có kích thước chỉ định
            if ($width > 0 && $height > 0) {
                $img->resize($width, $height);
            } elseif ($width > 0) {
                $img->resize(width: $width);
            } elseif ($height > 0) {
                $img->resize(height: $height);
            }
            
            // Chuyển đổi sang WebP và tối ưu hóa
            $encodedImage = $img->toWebp($quality);
            
            // Lưu vào storage với đường dẫn public/{directory}/{filename}
            $path = 'public/' . $directory . '/' . $filename;
            Storage::put($path, $encodedImage);
            
            // Trả về đường dẫn tương đối trong storage/app/public
            return $directory . '/' . $filename;
        }
        
        // Nếu là đường dẫn chuỗi (đã lưu trước đó)
        elseif (is_string($image) && Storage::exists('public/' . $image)) {
            return $image; // Giữ nguyên nếu đã tồn tại
        }
        
        return null;
    }

    /**
     * Xóa hình ảnh từ storage
     *
     * @param string|null $imagePath Đường dẫn hình ảnh cần xóa
     * @return bool
     */
    public function deleteImage(?string $imagePath): bool
    {
        if (!$imagePath) {
            return false;
        }

        $fullPath = 'public/' . $imagePath;
        if (Storage::exists($fullPath)) {
            return Storage::delete($fullPath);
        }

        return false;
    }
}