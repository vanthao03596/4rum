<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index($channelId, Thread $thread)
    {
        // $page = request('page', 0);
        // $limit = 5;
        // $offset = $page * $limit;
        // return $thread->replies()->offset($offset)->take($limit)->get();
        return $thread->replies()->orderBy('favorites_count', 'desc')->paginate(5);
    }

    /**
     * @param $channelId
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channelId, Thread $thread, StoreReplyRequest $request)
    {
        $reply = $thread->addReply([
            'message' => $request->message,
            'channel_id' => $channelId,
            'user_id' => auth()->id()
        ]);
        if (request()->expectsJson()) {
            return $reply->load('owner');
        }
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();
        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }
        // session()->flash('success', 'Your comment deleted successfully !');
        return back();
    }

    public function update(Reply $reply, Request $request)
    {
        dd($request->all());
        $reply->update($request->all());
    }
}
