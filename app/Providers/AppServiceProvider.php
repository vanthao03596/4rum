<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(app()->environment() === 'production'){
            URL::forceScheme('https');
        }

        View::composer('partials.header', 'App\Http\ViewComposers\HeaderComposer');
        View::composer('partials.sidebar', 'App\Http\ViewComposers\SideBarComposer');
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
