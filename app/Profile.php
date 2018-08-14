<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Profile
 *
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Profile extends Model
{
    protected $fillable = ['avatar', 'firstname', 'lastname', 'website', 'country', 'about', 'facebook', 'twitter', 'linkedin', 'google'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
