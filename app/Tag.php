<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Tag
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Thread[] $threads
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $fillable = ['name'];
    public function threads()
    {
        return $this->belongsToMany(Thread::class, 'thread_tag');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
