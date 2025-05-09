<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebDesign extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_order',
        'service_status',
        'carousel_order',
        'carousel_status',
    ];
}
