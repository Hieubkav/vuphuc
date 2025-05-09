<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tin tức',
                'description' => 'Các bài viết về tin tức mới nhất của công ty',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Kiến thức làm bánh',
                'description' => 'Chia sẻ kiến thức và kinh nghiệm làm bánh',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Công thức món mới',
                'description' => 'Các công thức món mới và cách thực hiện chi tiết',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Sự kiện',
                'description' => 'Thông tin về các sự kiện, triển lãm và hội thảo',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            $slug = Str::slug($category['name']);
            PostCategory::create([
                'name' => $category['name'],
                'slug' => $slug,
                'description' => $category['description'],
                'order' => $category['order'],
                'is_active' => $category['is_active'],
            ]);
        }
    }
}
