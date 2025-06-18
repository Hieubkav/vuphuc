<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Models\WebDesign;
use App\Observers\WebDesignObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Đăng ký Observer cho WebDesign
        WebDesign::observe(WebDesignObserver::class);

    //    Livewire::setScriptRoute(function ($handle) {
    //         return Route::get('/vuphuc/livewire/livewire.min.js?id=13b7c601', $handle);
    //     });

    //     Livewire::setUpdateRoute(function ($handle) {
    //         return Route::post('/vuphuc/livewire/update', $handle);
    //     });

    }
}
