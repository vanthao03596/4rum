<?php

namespace App;

use Laravel\Scout\Searchable;
use App\Traits\Favoritable;
use App\Traits\RecordActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Events\ThreadReceivedReply;

/**
 * App\Thread
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read \App\Channel $channel
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Favorite[] $favorites
 * @property-read mixed $created_at
 * @property-read mixed $favorite_count
 * @property-read mixed $is_favorited
 * @property-read mixed $replies_count
 * @property-read mixed $title
 * @property-read \App\Reply $latestReply
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reply[] $replies
 * @property-write mixed $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread filter($filter)
 * @mixin \Eloquent
 */
class Thread extends Model
{
    use Favoritable;
    use RecordActivity;
    use Searchable;
    // use Searchable;
    const POINT = 10;
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'body',
        'channel_id',
        'replies_count',
        'view_count',
        'locked'
    ];


    protected static function boot()
    {
        parent::boot();
        // static::addGlobalScope('creator', function (Builder  $builder) {
        //     $builder->with('creator');
        // });
        // static::addGlobalScope('channel', function (Builder  $builder) {
        //     $builder->with('channel');
        // });
        // static::addGlobalScope('favorites_count', function (Builder  $builder) {
        //     $builder->withCount('favorites');
        // });
        static::deleting(function ($thread) {
            $thread->replies->each->delete();
            $thread->creator->decrement('point', static::POINT);
        });
        static::created(function ($thread) {
            $thread->slug = str_slug($thread->title);
            $thread->save();
            $thread->creator->increment('point', static::POINT);
        });
    }


    public function path()
    {
        return '/threads/' . $this->channel->slug . '/' . $this->slug;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'thread_tag');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest()->withCount('favorites');
    }
    public static function getLatestReply()
    {
        return (new static)->with(['replies' => function ($q) {
            $q->latest();
        }])->get();
    }
    public function latestReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getRepliesCountAttribute($value)
    {
        return number_format($value);
    }

    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        event(new ThreadReceivedReply($reply));

        return $reply;
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function next()
    {
        return static::select('title', 'slug', 'channel_id')
                    ->where('id', '>', $this->id)
                    ->with('channel:id,slug')
                    ->orderBy('id', 'asc')
                    ->first();
    }

    public function previous()
    {
        return static::select('title', 'slug', 'channel_id')
                    ->where('id', '<', $this->id)
                    ->with('channel:id,slug')
                    ->orderBy('id', 'desc')
                    ->first();
    }

    public function related()
    {
        return static::where([
                'channel_id' => $this->channel->id
            ])
            ->where('id', '!=', $this->id)
            ->with('channel:id,slug')
            ->latest()
            ->take(5)
            ->get(['title', 'slug', 'channel_id']);
    }

    public function scopeFilter($query, $filter)
    {
        return $filter->apply($query);
    }

    public function setSlugAttribute($value)
    {
        $slug = str_slug($value);
        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-" . $this->id;
        }
        $this->attributes['slug'] = $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function hasUpdatedFor($user)
    {
        $key = sprintf("users.%s.visits.%s", auth()->id(), $this->id);

        return $this->updated_at > cache($key);
    }

    public function lock()
    {
        $this->update(['locked' => 1]);
    }

    public function unlock()
    {
        $this->update(['locked' => 0]);
    }

    public function isLocked()
    {
        return $this->locked == 1;
    }

    public function toSearchableArray()
    {
        return $this->load('channel', 'creator.profile', 'tags')->toArray() + ['path' => $this->path()];
    }
}
