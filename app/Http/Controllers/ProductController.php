<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm theo danh mục
     */
    public function category($slug)
    {
        $category = ProductCategory::where('slug', $slug)->where('status', 1)->firstOrFail();
        
        $products = Product::where('product_category_id', $category->id)
            ->where('status', 1)
            ->orderBy('featured', 'desc')
            ->orderBy('order')
            ->paginate(12);
            
        return view('storefront.products.category', compact('category', 'products'));
    }

    /**
     * Hiển thị trang danh sách tất cả danh mục
     */
    public function categories()
    {
        $categories = ProductCategory::where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();
            
        return view('storefront.products.categories', compact('categories'));
    }

    /**
     * Hiển thị chi tiết sản phẩm
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->with('productImages', 'productCategory')
            ->firstOrFail();
            
        $relatedProducts = Product::where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->limit(4)
            ->get();
            
        return view('storefront.products.show', compact('product', 'relatedProducts'));
    }
}
