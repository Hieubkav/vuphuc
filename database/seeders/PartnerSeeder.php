<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Rich Products Vietnam',
                'logo' => 'images/partners/rich-products.png',
                'website' => 'https://richproducts.vn/',
                'description' => 'Nhà phân phối độc quyền các sản phẩm Rich Products Vietnam khu vực Tây Nam',
                'order' => 1,
                'status' => true,
            ],
            [
                'name' => 'IREKS',
                'logo' => 'images/partners/ireks.png',
                'website' => 'https://www.ireks.vn/',
                'description' => 'Nhà cung cấp nguyên liệu bánh mì và bánh ngọt hàng đầu từ Đức',
                'order' => 2,
                'status' => true,
            ],
            [
                'name' => 'Puratos',
                'logo' => 'images/partners/puratos.png',
                'website' => 'https://www.puratos.vn/',
                'description' => 'Nhà sản xuất nguyên liệu bánh quốc tế chuyên nghiệp',
                'order' => 3,
                'status' => true,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
