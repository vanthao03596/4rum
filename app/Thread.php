<?php

namespace App;

use Laravel\Scout\Searchable;
use App\Traits\Favoritable;
use App\Traits\RecordActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Events\ThreadReceivedReply;

class Thread extends Model
{
    use Favoritable;
    use RecordActivity;
    // use Searchable;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'channel_id',
        'replies_count'
    ];


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('creator', function (Builder  $builder) {
            $builder->with('creator');
        });
        static::addGlobalScope('channel', function (Builder  $builder) {
            $builder->with('channel');
        });
        static::addGlobalScope('favorites_count', function (Builder  $builder) {
            $builder->withCount('favorites');
        });
        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
        static::created(function($thread) {
            $thread->slug = str_slug($thread->title);
            $thread->save();
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
        return $this->hasMany(Reply::class)->withCount('favorites');
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
        return Carbon::parse($value)->diffForHumans();
    }

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
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
        return Thread::withoutGlobalScopes()->where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }

    public function previous()
    {
        return Thread::withoutGlobalScopes()->where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }

    public function related()
    {
        return Thread::withoutGlobalScopes()->where([
            'channel_id' => $this->channel->id
            ])
            ->where('id', '!=', $this->id)
            ->latest()
            ->take(5)
            ->get();
    }

    public function scopeFilter($query, $filter)
    {
        return $filter->apply($query);
    }

    public function setSlugAttribute($value)
    {
        $slug = str_slug($value);
        if(static::whereSlug($slug)->exists()) {
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

    public function toSearchableArray()
    {
        return $this->toArray() + ['path' => $this->path()];
    }




}
