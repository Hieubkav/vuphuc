<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        // 'excerpt' đã được loại bỏ vì không có trong migration
        'thumbnail',
        'post_category_id',
        'featured',
        'order',
        'status',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
    
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}
