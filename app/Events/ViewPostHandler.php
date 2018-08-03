<?php

namespace App\Events;

use App\Thread;
use Illuminate\Session\Store;

class ViewPostHandler
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle(Thread $thread)
    {
        if (!$this->isPostViewed($thread))
        {
            $thread->increment('view_count');
            $this->storePost($thread);
        }
    }

    private function isPostViewed($thread)
    {
        $viewed = $this->session->get('viewed_posts', []);

        return array_key_exists($thread->id, $viewed);
    }

    private function storePost($thread)
    {
        $key = 'viewed_posts.' . $thread->id;

        $this->session->put($key, time());
    }
}
