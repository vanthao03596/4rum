<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Avatar;

class UserController extends Controller
{
    public function search()
    {
        $search = request('q');

        return User::where('name', 'LIKE', "$search%")
            ->take(5)
            ->pluck('name');
    }

    public function getUser()
    {
        return  User::with('profile')
                    ->where('id', '!=', auth()->id())
                    ->get()
                    ->map(function($user){
                        return [
                            'name' => $user->name,
                            'avatar' => asset($user->profile->avatar)
                        ];
                    });
    }
}
