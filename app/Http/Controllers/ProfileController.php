<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
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
            'user' => $user->load('profile')
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
            $questionToday = Thread::whereDate('created_at', Carbon::today())
                            ->where('user_id', auth()->id())
                            ->count();
            $answerToday = Reply::whereDate('created_at', Carbon::today())->where('user_id', auth()->id())
                            ->count();
            $questionMonth = Thread::whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])
                                    ->where('user_id', auth()->id())
                                    ->count();
            $answerMonth = Reply::whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])->where('user_id', auth()->id())
                                    ->count();
            $with['table'] = [
                'questionToday' => $questionToday,
                'answerToday' => $answerToday,
                'questionMonth' => $questionMonth,
                'answerMonth' => $answerMonth,
                'totalQuestion' => $questions->count(),
                'totalAnswer' => $answers->count()
            ];
        }
        return view('profiles.show')->with($with);
    }

    public function edit(User $user)
    {
        $profile = $user->profile;
        $this->authorize('view', $profile);
        $user = $user->load('profile');
        return view('profiles.edit-profile')->with('user', $user);
    }

    public function update(User $user, UpdateProfileRequest $request)
    {
        $profile = $user->profile;
        $this->authorize('update', $profile);
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $filename =  time() . '.' . $request->avatar->extension();
            $path = $request->file('avatar')->storeAs(
                'public/avatars', $filename
            );
            $data['avatar'] = 'avatars/' . $filename;
        } else {
            unset($data['avatar']);
        }
        $profile->update($data);
        return back()->with('status', 'Your Profile update successfully !');
    }
}
