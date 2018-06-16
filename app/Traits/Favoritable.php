<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Favorite;


/**
 *
 */
trait Favoritable
{
	public function favorites()
	{
		return $this->morphMany(Favorite::class, 'favorited');
	}

	public function favorite()
	{
		$attr = ['user_id' => auth()->id()];
		if ($this->favorites()->where($attr)->exists()) {
			$this->favorites()->where($attr)->delete();
		} else {
			$this->favorites()->create($attr);
		}
	}

	public function isFavorited()
	{
		return !!$this->favorites->where('user_id', auth()->id())->count();
	}
}
