<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = PostCategory::all();
        if ($categories->isEmpty()) {
            return;
        }

        $posts = [
            [
                'title' => 'Vũ Phúc Baking tổ chức khóa học làm bánh chuyên nghiệp',
                'content' => '<p>Vũ Phúc Baking vừa tổ chức thành công khóa học làm bánh chuyên nghiệp cho những người yêu thích làm bánh tại Cần Thơ. Khóa học kéo dài 3 ngày với sự tham gia của hơn 30 học viên.</p><p>Dưới sự hướng dẫn của các chuyên gia làm bánh hàng đầu, học viên đã được học cách làm các loại bánh như: bánh mì, bánh ngọt và bánh kem. Đây là một trong những hoạt động nhằm chia sẻ kiến thức và kỹ năng trong lĩnh vực làm bánh của Vũ Phúc Baking.</p>',
                'thumbnail' => null,
                'category_id' => $categories->where('name', 'Tin tức')->first()?->id ?? $categories->first()->id,
                'featured' => true,
                'status' => true,
            ],
            [
                'title' => 'Bí quyết làm bánh mì mềm xốp',
                'content' => '<p>Một trong những bí quyết để làm bánh mì mềm xốp là kiểm soát nhiệt độ và thời gian ủ bột. Việc ủ bột ở nhiệt độ phù hợp sẽ giúp men hoạt động tốt, tạo ra những bọt khí đều đặn trong bánh.</p><p>Ngoài ra, việc chọn đúng loại bột mì và phụ gia cũng rất quan trọng. Bột mì có hàm lượng gluten cao sẽ giúp bánh mì có cấu trúc chắc và đàn hồi tốt hơn.</p>',
                'thumbnail' => null,
                'category_id' => $categories->where('name', 'Kiến thức làm bánh')->first()?->id ?? $categories->first()->id,
                'featured' => true,
                'status' => true,
            ],
            [
                'title' => 'Công thức làm bánh Tiramisu đơn giản tại nhà',
                'content' => '<p>Tiramisu là một trong những món tráng miệng nổi tiếng của Ý, với hương vị đặc trưng từ cà phê và rượu Kahlua. Để làm bánh Tiramisu tại nhà, bạn cần chuẩn bị các nguyên liệu sau:</p>
                <ul>
                <li>200g bánh Savoiardi (Ladyfingers)</li>
                <li>250g mascarpone</li>
                <li>3 quả trứng (tách lòng đỏ và lòng trắng)</li>
                <li>100g đường</li>
                <li>200ml cà phê đen đậm đặc (đã để nguội)</li>
                <li>30ml rượu Kahlua (tùy chọn)</li>
                <li>Bột cacao để rắc lên mặt bánh</li>
                </ul>
                <p>Bước 1: Đánh lòng trắng trứng với đường cho đến khi bông và có độ cứng vừa phải.</p>
                <p>Bước 2: Trộn mascarpone với lòng đỏ trứng cho đến khi mịn.</p>
                <p>Bước 3: Nhẹ nhàng trộn hỗn hợp lòng trắng trứng vào hỗn hợp mascarpone.</p>
                <p>Bước 4: Nhúng bánh Savoiardi vào hỗn hợp cà phê và rượu Kahlua (nếu dùng), sau đó xếp một lớp bánh vào đáy đĩa.</p>
                <p>Bước 5: Phết một lớp hỗn hợp mascarpone lên trên lớp bánh.</p>
                <p>Bước 6: Lặp lại bước 4 và 5 cho đến khi hết nguyên liệu.</p>
                <p>Bước 7: Rắc bột cacao lên mặt bánh và để lạnh ít nhất 4 giờ trước khi dùng.</p>',
                'thumbnail' => null,
                'category_id' => $categories->where('name', 'Công thức món mới')->first()?->id ?? $categories->first()->id,
                'featured' => false,
                'status' => true,
            ],
            [
                'title' => 'Vũ Phúc Baking tham gia triển lãm Food & Hotel Vietnam 2025',
                'content' => '<p>Vũ Phúc Baking tự hào thông báo sẽ tham gia triển lãm Food & Hotel Vietnam 2025, một trong những sự kiện lớn nhất trong ngành công nghiệp thực phẩm và khách sạn tại Việt Nam.</p>
                <p>Trong khuôn khổ triển lãm, Vũ Phúc Baking sẽ giới thiệu các dòng sản phẩm mới nhất cùng với các thiết bị và dụng cụ làm bánh hiện đại. Đặc biệt, chúng tôi sẽ tổ chức các buổi demo làm bánh trực tiếp với sự tham gia của các đầu bếp hàng đầu.</p>
                <p>Triển lãm sẽ diễn ra từ ngày 10 đến ngày 12 tháng 6 năm 2025 tại Trung tâm Hội chợ và Triển lãm Sài Gòn (SECC), Quận 7, TP.HCM. Chúng tôi trân trọng kính mời quý khách hàng và đối tác đến tham quan gian hàng của Vũ Phúc Baking tại vị trí A12, Khu A.</p>',
                'thumbnail' => null,
                'category_id' => $categories->where('name', 'Sự kiện')->first()?->id ?? $categories->first()->id,
                'featured' => true,
                'status' => true,
            ],
        ];

        foreach ($posts as $post) {
            $slug = Str::slug($post['title']);
            Post::create([
                'title' => $post['title'],
                'slug' => $slug,
                'content' => $post['content'],
                'thumbnail' => $post['thumbnail'],
                'post_category_id' => $post['category_id'],
                'featured' => $post['featured'],
                'status' => $post['status'],
            ]);
        }
    }
}
