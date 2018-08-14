<?php

namespace App;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Favorite
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $favorited
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    use RecordActivity;

	protected $fillable = ['user_id', 'favorited_id', 'favorited_type'];

	public function favorited()
	{
		return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
