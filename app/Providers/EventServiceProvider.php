<?php

namespace App\Providers;

use App\Models\Carousel;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Service;
use App\Observers\CarouselObserver;
use App\Observers\PostObserver;
use App\Observers\ProductCategoryObserver;
use App\Observers\ProductImageObserver;
use App\Observers\ProductObserver;
use App\Observers\ServiceObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Đăng ký observer
        ProductCategory::observe(ProductCategoryObserver::class);
        Product::observe(ProductObserver::class);
        ProductImage::observe(ProductImageObserver::class);
        Carousel::observe(CarouselObserver::class);
        Post::observe(PostObserver::class);
        Service::observe(ServiceObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
