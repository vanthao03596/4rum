<?php
namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;
use App\Thread;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threadDay =  Reply::selectRaw('DATE(created_at) as date, count(*) as total')
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->groupBy('date')
                        ->orderBy('date')
                        ->pluck('total', 'date');
        $threads = Thread::selectRaw('DATE_FORMAT(created_at, "%M") as month, count(*) as total')->groupBy('month')->pluck('total', 'month');
        $replies = Reply::selectRaw('DATE_FORMAT(created_at, "%M") as month, count(*) as total')->groupBy('month')->pluck('total', 'month');
        $favorites = Favorite::selectRaw('DATE_FORMAT(created_at, "%M") as month, count(*) as total')->groupBy('month')->pluck('total', 'month');
        $latestQuestions = Thread::latest('id')->with('channel')->take(10)->get();
        $latestReplies = Reply::latest('id')->with('thread', 'owner', 'favorites')->take(10)->get();
        $userCount = User::count();
        $threadCount = Thread::count();
        $favoriteCount = Favorite::count();
        $replyCount = Reply::count();
        return view('admin.dashboard', compact('userCount',
            'threadCount',
            'favoriteCount',
            'replyCount',
            'threads',
            'replies',
            'favorites',
            'latestQuestions',
            'latestReplies',
            'threadDay'
        ));
    }
}
