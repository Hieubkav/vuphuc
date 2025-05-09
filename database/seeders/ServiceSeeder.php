<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Cung cấp nguyên liệu bánh',
                'image' => 'images/services/nguyen-lieu-banh.jpg',
                'description' => 'Cung cấp đầy đủ các loại nguyên liệu làm bánh chất lượng cao',
                'order' => 1,
                'status' => true,
            ],
            [
                'name' => 'Dụng cụ làm bánh',
                'image' => 'images/services/dung-cu-lam-banh.jpg',
                'description' => 'Đa dạng dụng cụ làm bánh từ các thương hiệu uy tín',
                'order' => 2,
                'status' => true,
            ],
            [
                'name' => 'Thiết bị nhà hàng',
                'image' => 'images/services/thiet-bi-nha-hang.jpg',
                'description' => 'Cung cấp thiết bị nhà hàng, khách sạn hiện đại',
                'order' => 3,
                'status' => true,
            ],
            [
                'name' => 'Đào tạo pha chế',
                'image' => 'images/services/dao-tao-pha-che.jpg',
                'description' => 'Đào tạo kỹ thuật làm bánh, pha chế chuyên nghiệp',
                'order' => 4,
                'status' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
