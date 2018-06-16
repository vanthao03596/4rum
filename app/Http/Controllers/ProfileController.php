<?php

namespace App\Http\Controllers;

use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
		$favId =  $user->favorites()
					->where('favorited_type', 'App\Thread')
					->pluck('favorited_id')
					->toArray();
		$favQuestions = Thread::whereIn('id', $favId);
		$questions = $user->threads()->withoutGlobalScopes(['creator']);
        $answers = $user->replies()->withoutGlobalScopes()->get();
		$totalPoint = 100;
		$with = [
			'favQuestionsCount' => $favQuestions->count(),
			'questionsCount' => $questions->count(),
			'answersCount' => $answers->count(),
			'totalPoint' => $totalPoint,
			'user' => $user
		];
		if (\Request::segment(3) == 'questions') {
			$with['questions'] = $questions->paginate(5);
		}
		if (\Request::segment(3) == 'favorite-questions') {
			$with['favQuestions'] = $favQuestions->paginate(5);
		}
		if (\Request::segment(3) == 'answers') {
			$with['answers'] = $answers;
		}
		if (\Request::segment(3) == 'points') {
			$with['history'] = 'abc';
		}
		return view('profiles.show')->with($with);

	}
}
