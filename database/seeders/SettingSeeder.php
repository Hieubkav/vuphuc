<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'company_name' => 'Vũ Phúc Baking',
            'email' => 'vuphucbaking@gmail.com',
            'phone' => '0292 3733 733',
            'youtube_url' => 'https://www.youtube.com/@vuphucbaking',
            'zalo_url' => 'https://zalo.me/vuphucbaking',
            'facebook_url' => 'https://www.facebook.com/vuphucbaking',
            'logo_url' => 'images/logo.png',
            'meta_description' => 'Vũ Phúc Baking - Nhà phân phối nguyên phụ liệu, dụng cụ, thiết bị ngành bánh, pha chế, nhà hàng tại khu vực ĐBSCL. Nhà phân phối độc quyền các sản phẩm Rich Products Vietnam khu vực Tây Nam.',
            'address1' => '1 Hoàng Quốc Việt, phường An Bình, quận Ninh Kiều, thành phố Cần Thơ',
            'address2' => 'Chi nhánh Sóc Trăng: Đường Lê Hồng Phong, Phường 3, TP. Sóc Trăng',
            'address3' => 'Chi nhánh Rạch Giá - Kiên Giang: 371C Nguyễn Trung Trực, P. Vĩnh Lạc, TP. Rạch Giá, Kiên Giang',
            'address4' => 'Chi nhánh Cà Mau: 289 Lý Thường Kiệt, P.9, Tp. Cà Mau',
            'address5' => 'Chi nhánh Long Xuyên - An Giang: 95H2 Trần Hưng Đạo, P. Mỹ Bình, TP. Long Xuyên',
        ]);
    }
}
