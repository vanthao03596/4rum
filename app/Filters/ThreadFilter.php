<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;

class ThreadFilter extends Filters
{
    protected $filters = ['by', 'popular', 'unanswered', 'recent'];

    /**
     * @param $username
     * @return mixed
     */
    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    public function popular()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }

    public function unanswered()
    {
        return $this->builder->where('replies_count', 0);
    }

    public function recent()
    {
        return $this->builder->latest();
    }
}
