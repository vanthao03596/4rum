<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Favorite;
use App\Thread;
use App\Reply;

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
        $threads = Thread::selectRaw('DATE_FORMAT(created_at, "%M") as month, count(*) as total')->groupBy('month')->pluck('total', 'month');
        $replies = Reply::selectRaw('DATE_FORMAT(created_at, "%M") as month, count(*) as total')->groupBy('month')->pluck('total', 'month');
        $favorites = Favorite::selectRaw('DATE_FORMAT(created_at, "%M") as month, count(*) as total')->groupBy('month')->pluck('total', 'month');
        $userCount = User::count();
        $threadCount = Thread::count();
        $favoriteCount = Favorite::count();
        $replyCount = Reply::count();
        return view('admin.dashboard', compact('userCount', 'threadCount', 'favoriteCount', 'replyCount', 'threads', 'replies', 'favorites'));
    }
}
