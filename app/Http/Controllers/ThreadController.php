<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilter;
use App\Http\Requests\StoreThreadRequest;
use App\Tag;
use App\Thread;
use Carbon\Carbon;
use Event;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'getData']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recent_question = Thread::with('creator:id,name', 'channel:id,slug')
            ->latest()
            ->take(10)
            ->get(['id', 'channel_id', 'user_id', 'title', 'slug', 'created_at', 'updated_at', 'view_count', 'locked', 'replies_count']);
        $most_response = Thread::with('creator:id,name', 'channel:id,slug')
            ->orderBy('replies_count', 'desc')
            ->take(10)
            ->get();

//         $recently_answer = Thread::join('replies', 'threads.id', '=', 'replies.thread_id')
//                 ->with('channel:id,slug')
//                 ->latest('replies.created_at')
//                 ->take(10)
//                 ->get();

        $recently_answer = Thread::with('creator:id,name', 'channel:id,slug')
            ->latest('updated_at')
            ->take(10)
            ->get();
        $no_answer = Thread::doesntHave('replies')->with('creator:id,name', 'channel:id,slug')->take(10)->get();
        return view('threads.index', compact('recent_question', 'most_response', 'recently_answer', 'no_answer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreThreadRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThreadRequest $request)
    {
        $tags = explode(',', $request->tags);
        foreach ($tags as $tag) {
            $tagId[] = Tag::firstOrCreate([
                'name' => $tag
            ])->id;
        }
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $thread = Thread::create($data);
        $thread->tags()->attach($tagId);
        session()->flash('status', 'Your Question created successfully !');
        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param $channelId
     * @param Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Thread $thread)
    {
        if (auth()->check()) {
            auth()->user()->read($thread);
        }
        Event::fire('threads.view', $thread);
        // $comments = $this->getComment($thread);
        $next = $thread->next();
        $previous = $thread->previous();
        $related = $thread->related();
        $thread = $thread->load('tags', 'channel');
        return view('threads.show', compact('thread', 'comments', 'next', 'previous', 'related'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $channel
     * @param Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize('delete', $thread);
        $thread->delete();
        session()->flash('status', 'Your question have been deleted !');
        return redirect()->route('threads.index');
    }

    /**
     * @param ThreadFilter $filter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getData(ThreadFilter $filter)
    {
        $threads = Thread::filter($filter);
        $threads = $threads->get();
        return view('channels.index', compact('threads'));
    }

    /**
     * @param Thread $thread
     * @return mixed
     */
    public function getComment(Thread $thread)
    {
        $comments = $thread->replies->groupBy('parent_id');
        if (count($comments)) {
            $comments['root'] = $comments[''];
            unset($comments['']);
        }
        return $comments;
    }
}
