<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\FeedObserver;
use App\Feed;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Feed::observe(FeedObserver::class);

    }
}
