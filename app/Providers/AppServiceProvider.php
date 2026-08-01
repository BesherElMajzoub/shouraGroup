<?php

namespace App\Providers;

use App\Models\Branch;
use Illuminate\Support\Facades\View;
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
        // The footer lists branches on every page, so share them with the layout only.
        View::composer('layouts.app', function ($view) {
            $view->with('footerBranches', Branch::where('is_active', true)->orderBy('order')->get());
        });
    }
}
