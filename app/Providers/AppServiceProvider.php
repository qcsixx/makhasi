<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Register model observers
        \App\Models\Makanan::observe(\App\Observers\MakananObserver::class);

        // Share settings with all views
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $settings = \Illuminate\Support\Facades\Cache::remember('app_settings', 60, function () {
                if (class_exists(\App\Models\Setting::class)) {
                    return \App\Models\Setting::pluck('value', 'key')->toArray();
                }
                return [];
            });
            $view->with('app_settings', $settings);
        });

        \Illuminate\Support\Facades\View::composer('layouts.admin', function ($view) {
            // Check if Daerah model exists to avoid errors on fresh install
            if (class_exists(\App\Models\Daerah::class)) {
                $view->with('total_daerah', \App\Models\Daerah::count());
            } else {
                $view->with('total_daerah', 0);
            }
        });
    }
}
