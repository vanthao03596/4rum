<?php

namespace App\ViewComponents;

use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Support\Htmlable;
use App\Channel;

class FooterComponent implements Htmlable
{

    public function toHtml()
    {
        return View::make('partials.footer')
            ->with('channels', Channel::take(5)->get())
            ->render();
    }
}
