<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Post;

class SearchController extends Controller
{
    /**
     * Tìm kiếm sản phẩm
     */
    public function products(Request $request)
    {
        $query = $request->get('q', '');
        $products = collect([]);
        $total = 0;

        if (!empty($query)) {
            $products = Product::where('status', 'active')
                ->where(function($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%')
                      ->orWhere('description', 'like', '%' . $query . '%')
                      ->orWhere('brand', 'like', '%' . $query . '%')
                      ->orWhere('sku', 'like', '%' . $query . '%');
                })
                ->with(['images' => function($q) {
                    $q->where('status', 'active')->orderBy('order');
                }, 'category'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            $total = $products->total();
        }

        if ($request->ajax()) {
            return response()->json([
                'products' => $products->items(),
                'total' => $total
            ]);
        }

        return view('search.products', [
            'query' => $query,
            'products' => $products,
            'total' => $total
        ]);
    }

    /**
     * Tìm kiếm bài viết
     */
    public function posts(Request $request)
    {
        $query = $request->get('q', '');
        $posts = collect([]);
        $total = 0;

        if (!empty($query)) {
            $posts = Post::where('status', 'active')
                ->where(function($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%')
                      ->orWhere('content', 'like', '%' . $query . '%');
                })
                ->with(['images' => function($q) {
                    $q->where('status', 'active')->orderBy('order');
                }, 'categories'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            $total = $posts->total();
        }

        if ($request->ajax()) {
            return response()->json([
                'posts' => $posts->items(),
                'total' => $total
            ]);
        }

        return view('search.posts', [
            'query' => $query,
            'posts' => $posts,
            'total' => $total
        ]);
    }

    /**
     * Tìm kiếm tổng hợp (cả sản phẩm và bài viết)
     */
    public function all(Request $request)
    {
        $query = $request->get('q', '');
        $products = collect([]);
        $posts = collect([]);
        $totalProducts = 0;
        $totalPosts = 0;

        if (!empty($query)) {
            // Tìm sản phẩm
            $products = Product::where('status', 'active')
                ->where(function($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%')
                      ->orWhere('description', 'like', '%' . $query . '%')
                      ->orWhere('brand', 'like', '%' . $query . '%')
                      ->orWhere('sku', 'like', '%' . $query . '%');
                })
                ->with(['images' => function($q) {
                    $q->where('status', 'active')->orderBy('order');
                }, 'category'])
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();

            $totalProducts = Product::where('status', 'active')
                ->where(function($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%')
                      ->orWhere('description', 'like', '%' . $query . '%')
                      ->orWhere('brand', 'like', '%' . $query . '%')
                      ->orWhere('sku', 'like', '%' . $query . '%');
                })
                ->count();

            // Tìm bài viết
            $posts = Post::where('status', 'active')
                ->where(function($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%')
                      ->orWhere('content', 'like', '%' . $query . '%');
                })
                ->with(['images' => function($q) {
                    $q->where('status', 'active')->orderBy('order');
                }, 'categories'])
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();

            $totalPosts = Post::where('status', 'active')
                ->where(function($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%')
                      ->orWhere('content', 'like', '%' . $query . '%');
                })
                ->count();
        }

        if ($request->ajax()) {
            return response()->json([
                'products' => $products,
                'posts' => $posts,
                'totalProducts' => $totalProducts,
                'totalPosts' => $totalPosts
            ]);
        }

        return view('search.all', [
            'query' => $query,
            'products' => $products,
            'posts' => $posts,
            'totalProducts' => $totalProducts,
            'totalPosts' => $totalPosts
        ]);
    }
}
