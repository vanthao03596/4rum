<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

class SearchController extends Controller
{
   public function show()
   {
        $search = request('q');
        $threads = Thread::search($search)->get();
        return view('search', compact('threads'));
   }
}
