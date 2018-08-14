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
            ->with('topUsers', User::latest('point')->with('profile:avatar,user_id')->take(3)->get(['id','name', 'point']))
            ->with('latestQuestions', Thread::latest('updated_at')->with('channel:id,slug')->take(3)->get(['id', 'channel_id', 'title', 'slug']));
    }
}
