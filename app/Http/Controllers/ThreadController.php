<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilter;
use App\Http\Requests\StoreThreadRequest;
use App\Thread;
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
        $recent_question = Thread::latest()->get();

        $most_response = Thread::orderBy('replies_count', 'desc')->get();

        $recently_answer = Thread::join('replies', 'threads.id', '=', 'replies.thread_id')
                ->latest('replies.created_at')
                ->take(5)
                ->get();
        $no_answer = Thread::doesntHave('replies')->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThreadRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $thread = Thread::create($data);
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
        $comments = $this->getComment($thread);
        $next = $thread->next();
        $previous = $thread->previous();
        $related = $thread->related();
        return view('threads.show', compact('thread', 'comments', 'next', 'previous', 'related'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize('delete', $thread);
        $thread->delete();
        return route('threads.index');
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
