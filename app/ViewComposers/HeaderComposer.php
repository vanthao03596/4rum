<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Channel;

class HeaderComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $channels = \Cache::rememberForever('channels', function () {
                return Channel::take(5)->get();
        });
        $view->with(['channels' => $channels]);
    }
}
