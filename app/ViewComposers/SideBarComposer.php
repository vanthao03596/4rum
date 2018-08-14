<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Tag;
use App\User;
use App\Thread;

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
        $view->with('allTags', Tag::pluck('name'))
            ->with('topUsers', User::latest('point')->take(3)->get())
            ->with('latestQuestions', Thread::latest()->take(3)->get());
    }
}
