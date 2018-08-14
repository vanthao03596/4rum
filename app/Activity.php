<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Activity
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subject
 * @mixin \Eloquent
 */
class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'subject_type',
        'type'
    ];


    public function subject()
    {
        return $this->morphTo();
    }
}
