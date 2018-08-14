<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Contact
 *
 * @mixin \Eloquent
 */
class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'website',
        'message'
    ];
}
