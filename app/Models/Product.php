<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'sale_price',
        'stock',
        'product_category_id',
        'featured',
        'status',
        'order',
    ];

    protected $casts = [
        'price' => 'float',
        'sale_price' => 'float',
        'stock' => 'integer',
        'featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * Lấy hình ảnh đại diện của sản phẩm (hình đầu tiên trong danh sách)
     *
     * @return string|null
     */
    public function getThumbnailAttribute(): ?string
    {
        // Lấy hình ảnh đầu tiên trong danh sách hình ảnh sản phẩm
        $firstImage = $this->productImages()->orderBy('order', 'asc')->first();
        
        return $firstImage ? $firstImage->image : null;
    }

    /**
     * Kiểm tra xem sản phẩm có đang giảm giá hay không
     *
     * @return bool
     */
    public function hasDiscount(): bool
    {
        return !is_null($this->sale_price) && $this->sale_price < $this->price;
    }

    /**
     * Lấy giá hiện tại của sản phẩm (giá khuyến mãi hoặc giá gốc)
     *
     * @return float
     */
    public function getCurrentPrice(): float
    {
        return $this->hasDiscount() ? $this->sale_price : $this->price;
    }

    /**
     * Lấy phần trăm giảm giá
     *
     * @return int|null
     */
    public function getDiscountPercentage(): ?int
    {
        if (!$this->hasDiscount()) {
            return null;
        }

        return (int) (100 - ($this->sale_price / $this->price * 100));
    }
}
