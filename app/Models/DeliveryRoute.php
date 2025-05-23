<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'order',
        'status',
    ];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
