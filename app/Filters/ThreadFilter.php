<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;

class ThreadFilter extends Filters
{
    protected $filters = ['by', 'popular'];

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


}