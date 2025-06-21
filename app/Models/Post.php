<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ClearsViewCache;

class Post extends Model
{
    use HasFactory, ClearsViewCache;

    protected $fillable = [
        'title',
        'content',
        'content_builder',
        'seo_title',
        'seo_description',
        'og_image_link',
        'slug',
        'thumbnail',
        'is_featured',
        'type',
        'order',
        'status',
    ];

    protected $casts = [
        'content_builder' => 'array',
        'is_featured' => 'boolean',
        'status' => 'string',
        'type' => 'string',
        'order' => 'integer',
    ];

    // Quan hệ với PostImage
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    // Quan hệ với MenuItem
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    // Quan hệ với CatPost (many-to-many)
    public function categories()
    {
        return $this->belongsToMany(CatPost::class, 'post_categories', 'post_id', 'cat_post_id');
    }

    // Alias để tương thích với code cũ - lấy category đầu tiên
    public function getCategoryAttribute()
    {
        return $this->categories()->first();
    }

    // Quan hệ với PostView
    public function views()
    {
        return $this->hasMany(PostView::class);
    }

    // Lấy tổng số lượt xem
    public function getTotalViewsAttribute()
    {
        return $this->views()->count();
    }

    // Lấy số người xem khác nhau
    public function getUniqueViewsAttribute()
    {
        return $this->views()->distinct('ip_address')->count();
    }
}
