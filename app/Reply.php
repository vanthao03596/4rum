<?php

namespace App;

use App\Traits\Favoritable;
use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable,RecordActivity;

    protected $fillable = [
        'thread_id',
        'user_id',
        'message'
    ];
    protected $appends = ['isFavorited'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('owner', function ($builder) {
            $builder->with('owner.profile');
        });
        static::addGlobalScope('favorites', function ($builder) {
            $builder->with('favorites');
        });
        static::created(function ($reply) {
            $reply->thread->increment('replies_count');
        });
        static::deleted(function ($reply) {
            $reply->thread->decrement('replies_count');
        });
    }

    // protected $with = ['owner', 'favorites'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }

    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+)/', $this->message, $matches);
        return $matches[1];
    }

    public function setMessageAttribute($body)
    {
        $this->attributes['message'] = preg_replace('/@([\w\-]+)/', '<a href="/profile/$1">$0</a>', $body);
    }
}
