<?php

namespace App;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

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
