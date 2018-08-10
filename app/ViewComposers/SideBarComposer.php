<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Tag;

class SideBarComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('allTags', Tag::pluck('name'));
    }
}
