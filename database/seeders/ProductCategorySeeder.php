<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Nguyên liệu làm bánh',
                'description' => 'Các loại nguyên liệu dùng để làm bánh chất lượng cao',
                'order' => 1,
                'status' => true,
            ],
            [
                'name' => 'Dụng cụ làm bánh',
                'description' => 'Dụng cụ làm bánh chuyên nghiệp từ các thương hiệu uy tín',
                'order' => 2,
                'status' => true,
            ],
            [
                'name' => 'Thiết bị nhà hàng',
                'description' => 'Các loại thiết bị dành cho nhà hàng, khách sạn',
                'order' => 3,
                'status' => true,
            ],
            [
                'name' => 'Thiết bị pha chế',
                'description' => 'Thiết bị chuyên dụng cho pha chế đồ uống',
                'order' => 4,
                'status' => true,
            ],
            [
                'name' => 'Bột làm bánh',
                'description' => 'Các loại bột chuyên dụng để làm bánh',
                'order' => 5,
                'parent_id' => 1,
                'status' => true,
            ],
            [
                'name' => 'Phụ gia làm bánh',
                'description' => 'Các loại phụ gia dùng trong làm bánh',
                'order' => 6,
                'parent_id' => 1,
                'status' => true,
            ],
        ];

        // First create parent categories
        foreach ($categories as $key => $category) {
            if (!isset($category['parent_id'])) {
                $slug = Str::slug($category['name']);
                $createdCategory = ProductCategory::create([
                    'name' => $category['name'],
                    'slug' => $slug,
                    'description' => $category['description'],
                    'order' => $category['order'],
                    'parent_id' => null,
                    'status' => $category['status'],
                ]);
                
                // Store the ID for reference by child categories
                $categories[$key]['db_id'] = $createdCategory->id;
            }
        }

        // Then create child categories
        foreach ($categories as $category) {
            if (isset($category['parent_id'])) {
                $parentKey = $category['parent_id'] - 1; // Adjust for zero-based array index
                $slug = Str::slug($category['name']);
                ProductCategory::create([
                    'name' => $category['name'],
                    'slug' => $slug,
                    'description' => $category['description'],
                    'order' => $category['order'],
                    'parent_id' => $categories[$parentKey]['db_id'],
                    'status' => $category['status'],
                ]);
            }
        }
    }
}
