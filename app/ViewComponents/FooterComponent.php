<?php

namespace App\ViewComponents;

use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Support\Htmlable;
use App\Channel;

class FooterComponent implements Htmlable
{

    public function toHtml()
    {
        $channels = \Cache::rememberForever('channels', function () {
                return Channel::take(5)->get();
        });
        return View::make('partials.footer')
            ->with('channels', $channels)
            ->render();
    }
}
