<?php

namespace App\Observers;

use App\Models\WebDesign;
use App\Services\WebDesignService;

class WebDesignObserver
{
    /**
     * Handle the WebDesign "created" event.
     */
    public function created(WebDesign $webDesign): void
    {
        $this->clearCache();
    }

    /**
     * Handle the WebDesign "updated" event.
     */
    public function updated(WebDesign $webDesign): void
    {
        $this->clearCache();
    }

    /**
     * Handle the WebDesign "deleted" event.
     */
    public function deleted(WebDesign $webDesign): void
    {
        $this->clearCache();
    }

    /**
     * Handle the WebDesign "restored" event.
     */
    public function restored(WebDesign $webDesign): void
    {
        $this->clearCache();
    }

    /**
     * Handle the WebDesign "force deleted" event.
     */
    public function forceDeleted(WebDesign $webDesign): void
    {
        $this->clearCache();
    }

    /**
     * Clear WebDesign cache
     */
    private function clearCache(): void
    {
        app(WebDesignService::class)->clearCache();
    }
}
