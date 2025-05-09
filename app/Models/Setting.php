<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'phone',
        'youtube_url',
        'zalo_url',
        'facebook_url',
        'logo_url',
        'meta_description',
        'address1',
        'address2',
        'address3',
        'address4',
        'address5',
    ];
}
