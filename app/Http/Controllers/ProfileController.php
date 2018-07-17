<?php

namespace App\Http\Controllers;

use App\Thread;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Reply;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $favId =  $user->favorites()
                    ->where('favorited_type', 'App\Thread')
                    ->pluck('favorited_id')
                    ->toArray();
        $favorites = Thread::whereIn('id', $favId);
        $questions = $user->threads()->withoutGlobalScopes(['creator']);
        $answers = $user->replies()->withoutGlobalScopes();
        $totalPoint = 100;
        $with = [
            'favQuestionsCount' => $favorites->count(),
            'questionsCount' => $questions->count(),
            'answersCount' => $answers->count(),
            'totalPoint' => $totalPoint,
            'user' => $user
        ];
        if (\Request::segment(3) == 'questions') {
            $with['questions'] = $questions->paginate(5);
        }
        if (\Request::segment(3) == 'favorites') {
            $with['favorites'] = $favorites->paginate(5);
        }
        if (\Request::segment(3) == 'answers') {
            $with['answers'] = $answers->paginate(5);
        }
        if (\Request::segment(3) == 'histories') {
            $with['histories'] = 'abc';
        }
        if (\Request::segment(3) == '') {
            $questionToday = Thread::whereDate('created_at', Carbon::today())->where('user_id', auth()->id())->count();
            $answerToday = Reply::whereDate('created_at', Carbon::today())->where('user_id', auth()->id())->count();
            $questionMonth = Thread::whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()])->where('user_id', auth()->id())->count();
            $answerMonth = Reply::whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()])->where('user_id', auth()->id())->count();
            $with['table'] = [
                'questionToday' => $questionToday,
                'answerToday' => $questionMonth,
                'questionMonth' => $questionMonth,
                'answerMonth' => $answerMonth,
                'totalQuestion' => $questions->count(),
                'totalAnswer' => $answers->count()
            ];
        }
        return view('profiles.show')->with($with);
    }
}
