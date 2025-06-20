<?php

use App\Http\Controllers\EcomerceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Artisan;

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'storeFront')->name('storeFront');
});

Route::controller(EcomerceController::class)->group(function () {
    Route::get('/ban-hang', 'index')->name('ecomerce.index');
});

// Thêm route cho sản phẩm và danh mục
Route::controller(ProductController::class)->group(function () {
    Route::get('/danh-muc/{slug}', 'category')->name('products.category');
    Route::get('/danh-muc', 'categories')->name('products.categories');
    Route::get('/san-pham/{slug}', 'show')->name('products.show');
});

// Thêm route cho bài viết và dịch vụ
Route::controller(PostController::class)->group(function () {
    Route::get('/danh-muc-bai-viet/{slug}', 'category')->name('posts.category');
    Route::get('/danh-muc-bai-viet', 'categories')->name('posts.categories');
    Route::get('/bai-viet/{slug}', 'show')->name('posts.show');

    // Route tổng thể cho tất cả bài viết với filter
    Route::get('/bai-viet', 'index')->name('posts.index');

    // Redirect các route cũ về trang filter tổng thể
    Route::get('/dich-vu', function() {
        return redirect()->route('posts.index', ['type' => 'service']);
    })->name('posts.services');

    Route::get('/tin-tuc', function() {
        return redirect()->route('posts.index', ['type' => 'news']);
    })->name('posts.news');

    Route::get('/khoa-hoc', function() {
        return redirect()->route('posts.index', ['type' => 'course']);
    })->name('posts.courses');
});

// Thêm route cho nhân viên
Route::controller(EmployeeController::class)->group(function () {
    // Route danh sách nhân viên - yêu cầu đăng nhập
    Route::get('/nhan-vien', 'index')->name('employee.index')->middleware('auth');

    // Route profile công khai
    Route::get('/nhan-vien/{slug}', 'profile')->name('employee.profile');
    Route::get('/nhan-vien/{slug}/qr-code', 'showQrCode')->name('employee.qr-code');
    Route::get('/nhan-vien/{slug}/qr-download', 'downloadQrCode')->name('employee.qr-download');
});

// Routes cho customer authentication
Route::controller(CustomerAuthController::class)->group(function () {
    Route::get('/khach-hang/dang-nhap', 'showLoginForm')->name('customer.login')->middleware('customer.guest');
    Route::post('/khach-hang/dang-nhap', 'login')->middleware('customer.guest');
    Route::get('/khach-hang/dang-ky', 'showRegisterForm')->name('customer.register')->middleware('customer.guest');
    Route::post('/khach-hang/dang-ky', 'register')->middleware('customer.guest');
    Route::post('/khach-hang/dang-xuat', 'logout')->name('customer.logout')->middleware('auth:customer');
    Route::get('/khach-hang/thong-tin', 'showProfile')->name('customer.profile')->middleware('auth:customer');
});

// Routes cho customer orders (yêu cầu đăng nhập)
Route::middleware('auth:customer')->group(function () {
    Route::controller(CustomerOrderController::class)->group(function () {
        Route::get('/khach-hang/don-hang', 'index')->name('customer.orders.index');
        Route::get('/khach-hang/don-hang/{orderNumber}', 'show')->name('customer.orders.show');
        Route::patch('/khach-hang/don-hang/{orderNumber}/huy', 'cancel')->name('customer.orders.cancel');
    });
});

// SEO routes
Route::controller(SitemapController::class)->group(function () {
    Route::get('/sitemap.xml', 'index')->name('sitemap');
    Route::get('/robots.txt', 'robots')->name('robots');
});

// Routes tìm kiếm
Route::controller(SearchController::class)->group(function () {
    Route::get('/tim-kiem', 'all')->name('search.all');
    Route::get('/tim-kiem/san-pham', 'products')->name('products.search');
    Route::get('/tim-kiem/bai-viet', 'posts')->name('posts.search');
});

// Route clear cache
Route::post('/clear-cache', function () {
    \App\Providers\ViewServiceProvider::refreshCache('navigation');
    return response()->json(['message' => 'Cache cleared successfully!']);
})->name('clear.cache');

Route::get('/run-storage-link', function () {
    try {
        Artisan::call('storage:link');
        return response()->json(['message' => 'Storage linked successfully!'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

// Debug route - tạm thời
Route::get('/debug-products', function () {
    $product = \App\Models\Product::with('images')->where('is_hot', true)->first();
    if ($product) {
        $data = [
            'product_name' => $product->name,
            'images_count' => $product->images->count(),
            'images' => $product->images->map(function($image) {
                return [
                    'id' => $image->id,
                    'image_link' => $image->image_link,
                    'is_main' => $image->is_main,
                    'status' => $image->status,
                    'order' => $image->order
                ];
            }),
            'getProductImageUrl_result' => getProductImageUrl($product)
        ];
        return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }
    return response()->json(['message' => 'No hot products found'], 404);
});

// Debug post route
Route::get('/debug-post/{id}', function ($id) {
    $post = \App\Models\Post::find($id);
    if ($post) {
        $data = [
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'status' => $post->status,
            'type' => $post->type,
            'content_length' => strlen($post->content ?? ''),
            'content_builder_count' => is_array($post->content_builder) ? count($post->content_builder) : 0,
            'content_builder_data' => $post->content_builder,
            'updated_at' => $post->updated_at,
            'route_url' => route('posts.show', $post->slug)
        ];
        return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }
    return response()->json(['message' => 'Post not found'], 404);
});

// Debug partners route
Route::get('/debug-partners', function() {
    $partners = \App\Models\Partner::all();
    $activePartners = \App\Models\Partner::where('status', 'active')->orderBy('order')->get();

    return response()->json([
        'total_partners' => $partners->count(),
        'active_partners' => $activePartners->count(),
        'all_partners' => $partners->map(function($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'status' => $p->status,
                'order' => $p->order,
                'logo_link' => $p->logo_link
            ];
        }),
        'active_partners_data' => $activePartners->map(function($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'status' => $p->status,
                'order' => $p->order,
                'logo_link' => $p->logo_link
            ];
        })
    ], 200, [], JSON_PRETTY_PRINT);
});




