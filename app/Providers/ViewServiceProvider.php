<?php

namespace App\Providers;

use App\Models\Cat;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Chia sẻ settings với tất cả các view
        View::composer('*', function ($view) {
            // Lấy settings từ database hoặc cache
            $settings = Setting::first();
            
            // Chia sẻ biến settings với view
            $view->with('settings', $settings);
        });
    }
}
