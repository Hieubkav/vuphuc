<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ProductCategory::all();
        if ($categories->isEmpty()) {
            return;
        }

        $products = [
            [
                'name' => 'Bột mì số 8 Rich 1kg',
                'description' => '<p>Bột mì số 8 Rich là loại bột mì đa năng chất lượng cao, phù hợp cho nhiều loại bánh khác nhau. Với hàm lượng protein vừa phải, bột mì số 8 Rich đặc biệt thích hợp cho việc làm bánh bông lan, bánh quy và các loại bánh ngọt nhẹ.</p>
                <p><strong>Thông tin sản phẩm:</strong></p>
                <ul>
                    <li>Khối lượng: 1kg/gói</li>
                    <li>Hàm lượng Protein: 8-9%</li>
                    <li>Xuất xứ: Việt Nam</li>
                    <li>Thương hiệu: Rich Products Vietnam</li>
                </ul>',
                'price' => 25000,
                'sale_price' => 22000,
                'sku' => 'BM-RICH-08-1KG',
                'category_id' => $categories->where('name', 'Bột làm bánh')->first()?->id ?? $categories->first()->id,
                'featured' => true,
                'status' => true,
                'stock' => 100,
            ],
            [
                'name' => 'Bột mì số 13 Rich 1kg',
                'description' => '<p>Bột mì số 13 Rich là loại bột mì có hàm lượng gluten cao, chuyên dụng cho việc làm bánh mì và các loại bánh cần độ dai và đàn hồi tốt. Với hàm lượng protein cao, bột mì số 13 Rich giúp tạo ra các sản phẩm bánh mì có cấu trúc chắc, vỏ giòn và ruột mềm xốp.</p>
                <p><strong>Thông tin sản phẩm:</strong></p>
                <ul>
                    <li>Khối lượng: 1kg/gói</li>
                    <li>Hàm lượng Protein: 12-13%</li>
                    <li>Xuất xứ: Việt Nam</li>
                    <li>Thương hiệu: Rich Products Vietnam</li>
                </ul>',
                'price' => 28000,
                'sale_price' => null,
                'sku' => 'BM-RICH-13-1KG',
                'category_id' => $categories->where('name', 'Bột làm bánh')->first()?->id ?? $categories->first()->id,
                'featured' => false,
                'status' => true,
                'stock' => 150,
            ],
            [
                'name' => 'Máy đánh trứng cầm tay Philips 400W',
                'description' => '<p>Máy đánh trứng cầm tay Philips với công suất 400W, thiết kế hiện đại và bền bỉ, là trợ thủ đắc lực trong việc làm bánh. Máy có 5 mức tốc độ khác nhau và chế độ Turbo giúp đánh trứng nhanh chóng và hiệu quả.</p>
                <p><strong>Thông tin sản phẩm:</strong></p>
                <ul>
                    <li>Công suất: 400W</li>
                    <li>Vật liệu: Nhựa cao cấp và thép không gỉ</li>
                    <li>Số cấp độ tốc độ: 5 + Turbo</li>
                    <li>Bảo hành: 24 tháng</li>
                    <li>Xuất xứ: Trung Quốc</li>
                    <li>Thương hiệu: Philips</li>
                </ul>',
                'price' => 750000,
                'sale_price' => 650000,
                'sku' => 'DCB-PHIL-400W',
                'category_id' => $categories->where('name', 'Dụng cụ làm bánh')->first()?->id ?? $categories->first()->id,
                'featured' => true,
                'status' => true,
                'stock' => 30,
            ],
            [
                'name' => 'Khuôn bánh tròn chống dính 20cm',
                'description' => '<p>Khuôn bánh tròn chống dính với đường kính 20cm, được làm từ thép carbon phủ lớp chống dính cao cấp, giúp bánh không bị dính và dễ dàng tháo khuôn.</p>
                <p><strong>Thông tin sản phẩm:</strong></p>
                <ul>
                    <li>Kích thước: Đường kính 20cm</li>
                    <li>Vật liệu: Thép carbon phủ lớp chống dính</li>
                    <li>Màu sắc: Đen</li>
                    <li>Xuất xứ: Đài Loan</li>
                </ul>',
                'price' => 120000,
                'sale_price' => 100000,
                'sku' => 'KB-TRON-20CM',
                'category_id' => $categories->where('name', 'Dụng cụ làm bánh')->first()?->id ?? $categories->first()->id,
                'featured' => false,
                'status' => true,
                'stock' => 50,
            ],
            [
                'name' => 'Máy pha cà phê espresso Breville 870',
                'description' => '<p>Máy pha cà phê espresso Breville 870 được thiết kế chuyên nghiệp với áp suất 15 bar, giúp chiết xuất hương vị cà phê đậm đà. Máy được trang bị bộ phận tạo bọt sữa chuyên nghiệp, lý tưởng cho việc pha chế các loại đồ uống như cappuccino và latte.</p>
                <p><strong>Thông tin sản phẩm:</strong></p>
                <ul>
                    <li>Công suất: 1700W</li>
                    <li>Áp suất: 15 bar</li>
                    <li>Dung tích bình chứa: 2 lít</li>
                    <li>Chức năng: Pha espresso, tạo bọt sữa, hâm nóng nước</li>
                    <li>Bảo hành: 24 tháng</li>
                    <li>Xuất xứ: Úc</li>
                    <li>Thương hiệu: Breville</li>
                </ul>',
                'price' => 8500000,
                'sale_price' => null,
                'sku' => 'TBP-BREV-870',
                'category_id' => $categories->where('name', 'Thiết bị pha chế')->first()?->id ?? $categories->first()->id,
                'featured' => true,
                'status' => true,
                'stock' => 10,
            ],
        ];

        foreach ($products as $product) {
            $slug = Str::slug($product['name']);
            Product::create([
                'name' => $product['name'],
                'slug' => $slug,
                'description' => $product['description'],
                'price' => $product['price'],
                'sale_price' => $product['sale_price'],
                'sku' => $product['sku'],
                'product_category_id' => $product['category_id'],
                'featured' => $product['featured'],
                'status' => $product['status'],
                'stock' => $product['stock'],
            ]);
        }
    }
}
