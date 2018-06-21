<?php

namespace App;

use App\Traits\Favoritable;
use App\Traits\RecordActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use Favoritable;
    use RecordActivity;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'channel_id'
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
        static::addGlobalScope('replies_count', function (Builder  $builder) {
            $builder->withCount('replies');
        });
        static::addGlobalScope('favorites_count', function (Builder  $builder) {
            $builder->withCount('favorites');
        });
        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
    }


    public function path()
    {
        return '/threads/' . $this->channel->slug . '/' . $this->id;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest()->withCount('favorites');
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
        $this->replies()->create($reply);
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
}
