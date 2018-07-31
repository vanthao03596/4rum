<?php

namespace App;

use Avatar;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected static function boot()
    {
        static::created(function ($user) {
            $fileName = uniqid(). '.jpg';
            $avartaPath = 'app/public/avatars/' . $fileName;
            Avatar::create($user->name)->save(storage_path($avartaPath), 100);
            $user->profile()->create([
                'avatar' => 'avatars/' . $fileName
            ]);
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }


    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function visitedThreadCacheKey($thread)
    {
        return sprintf("users.%s.visits.%s", $this->id, $thread->id);
    }

    public function read($thread)
    {
        cache()->forever($this->visitedThreadCacheKey($thread), Carbon::now());
    }

    public function getAvatarAttribute()
    {
        return asset('storage/' . $this->profile->avatar);
    }
}
