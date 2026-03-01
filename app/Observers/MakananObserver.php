<?php

namespace App\Observers;

use App\Models\Makanan;
use Illuminate\Support\Facades\Cache;

class MakananObserver
{
    /**
     * Handle the Makanan "created" event.
     */
    public function created(Makanan $makanan): void
    {
        $this->clearCaches($makanan);
    }

    /**
     * Handle the Makanan "updated" event.
     */
    public function updated(Makanan $makanan): void
    {
        $this->clearCaches($makanan);
    }

    /**
     * Handle the Makanan "deleted" event.
     */
    public function deleted(Makanan $makanan): void
    {
        $this->clearCaches($makanan);
    }

    /**
     * Handle the Makanan "restored" event.
     */
    public function restored(Makanan $makanan): void
    {
        $this->clearCaches($makanan);
    }

    /**
     * Clear relevant caches.
     */
    protected function clearCaches(Makanan $makanan): void
    {
        Cache::forget("food_item_{$makanan->id}");
        Cache::forget('dashboard_stats');
        Cache::forget('popular_foods');
    }
}
