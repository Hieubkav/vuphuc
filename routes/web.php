<?php

use App\Http\Controllers\EcomerceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TutorialController;
use Illuminate\Support\Facades\Artisan;

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'storeFront')->name('storeFront');
});

Route::controller(EcomerceController::class)->group(function () {
    Route::get('/ban-hang', 'index')->name('ecomerce.index');
});

Route::controller(TutorialController::class)->group(function () {
    Route::get('/khoa-hoc', 'index')->name('tutorial.index');
});

// Thêm route cho sản phẩm và danh mục
Route::controller(ProductController::class)->group(function () {
    Route::get('/danh-muc/{slug}', 'category')->name('products.category');
    Route::get('/danh-muc', 'categories')->name('products.categories');
    Route::get('/san-pham/{slug}', 'show')->name('products.show');
});

Route::get('/run-storage-link', function () {
    try {
        Artisan::call('storage:link');
        return response()->json(['message' => 'Storage linked successfully!'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
