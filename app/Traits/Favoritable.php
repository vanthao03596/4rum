<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Favorite;

/**
 *
 */
trait Favoritable
{
    protected static function bootFavoritable()
    {
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });
    }
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $attr = ['user_id' => auth()->id()];
        if (!$this->favorites()->where($attr)->exists()) {
            $this->favorites()->create($attr);
        }
    }
    public function unfavorite()
    {
        $attr = ['user_id' => auth()->id()];
        $this->favorites()->where($attr)->get()->each->delete();
    }

    public function isFavorited()
    {
        return !!$this->favorites->where('user_id', auth()->id())->count();
    }
    public function getFavoriteCountAttribute()
    {
        return $this->favorites->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }
}
