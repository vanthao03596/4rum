<?php

namespace App\Observers;

use App\Thread;
use App\Activity;

class ThreadsObservers
{
    public function deleting(Thread $thread)
    {
        $thread->replies()->delete();
    }

    public function created(Thread $thread)
    {
        $thread->activity()->create([
            'user_id' => $thread->user_id,
            'type' => 'created_' . strtolower((new \ReflectionClass($thread))->getShortName()),
        ]);
    }
}
