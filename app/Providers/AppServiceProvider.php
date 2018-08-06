<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Channel;
use App\Tag;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceScheme('https');
        view()->composer(['*'], function ($view) {
            $channels = \Cache::rememberForever('channels', function () {
                return Channel::all();
            });
            $view->with(['channels' => $channels]);
        });
        view()->composer('partials.sidebar', function($view) {
            $view->with('allTags', Tag::pluck('name'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
