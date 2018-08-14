<?php

namespace App;

use App\Traits\Favoritable;
use App\Traits\RecordActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Reply
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read \App\Channel $channel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Favorite[] $favorites
 * @property-read mixed $created_at
 * @property-read mixed $favorite_count
 * @property-read mixed $is_favorited
 * @property-read mixed $short_message
 * @property-read \App\User $owner
 * @property-write mixed $message
 * @property-read \App\Thread $thread
 * @mixin \Eloquent
 */
class Reply extends Model
{
    use Favoritable,RecordActivity;

    const POINT = 5;
    protected $fillable = [
        'thread_id',
        'user_id',
        'message'
    ];
    // protected $appends = ['isFavorited'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($reply) {
            $reply->thread->increment('replies_count');
            $reply->owner->increment('point', static::POINT);
        });
        static::deleted(function ($reply) {
            $reply->thread->decrement('replies_count');
            $reply->owner->decrement('point', static::POINT);
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

    public function getShortMessageAttribute() {
        return substr($this->message, 1,40) . ' ...';
    }

    // public function getCreatedAtAttribute($value)
    // {
    //     return Carbon::parse($value)->diffForHumans();
    // }
    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-.]+)/', $this->message, $matches);
        return $matches[1];
    }


    public function setMessageAttribute($body)
    {
        $this->attributes['message'] = preg_replace('/@([\w\-.]+)/', '<a href="/profile/$1">$0</a>', $body);
    }
}
