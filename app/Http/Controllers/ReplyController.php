<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $channelId
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channelId, Thread $thread)
    {
        $thread->addReply([
            'message' => request('message'),
            'channel_id' => $channelId,
            'user_id' => auth()->id()
        ]);
        session()->flash('success', 'Your comment post successfully !');
        return back();
    }
}
