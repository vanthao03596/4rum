<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Channel extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];
    protected static function boot()
    {
        parent::boot();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return route('channels.index', $this->slug);
    }
}
