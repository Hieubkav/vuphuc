<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PostView extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'ip_address',
        'session_id',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    /**
     * Quan hệ với Post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Ghi lại lượt xem bài viết
     */
    public static function recordView(int $postId, string $ipAddress): void
    {
        // Kiểm tra xem IP này đã xem bài viết này trong 24h qua chưa
        $existingView = static::where('post_id', $postId)
            ->where('ip_address', $ipAddress)
            ->where('viewed_at', '>=', Carbon::now()->subDay())
            ->first();

        if (!$existingView) {
            static::create([
                'post_id' => $postId,
                'ip_address' => $ipAddress,
                'session_id' => session()->getId(),
                'viewed_at' => now(),
            ]);
        }
    }

    /**
     * Lấy top bài viết được xem nhiều nhất
     */
    public static function getTopPosts(int $limit = 3)
    {
        return static::selectRaw('post_id, COUNT(*) as total_views, COUNT(DISTINCT ip_address) as unique_views')
            ->with('post')
            ->groupBy('post_id')
            ->orderBy('total_views', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Xóa tất cả dữ liệu tracking
     */
    public static function resetAll(): void
    {
        static::truncate();
    }
}
