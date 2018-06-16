<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Favoritable;

class Reply extends Model
{
    use Favoritable;

    protected $fillable = [
        'thread_id',
        'user_id',
        'message'
    ];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('owner', function ($builder) {
            $builder->with('owner');
        });
        static::addGlobalScope('favorites', function ($builder) {
            $builder->with('favorites');
        });
    }

    // protected $with = ['owner', 'favorites'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::Class, 'thread_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }




}
