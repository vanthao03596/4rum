<?php

namespace App\Providers;

use App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        \Blade::directive('render', function ($component) {
            return "<?php echo (app($component))->toHtml(); ?>";
        });

        View::composer(['partials.header', 'threads.create'], 'App\Http\ViewComposers\HeaderComposer');
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
