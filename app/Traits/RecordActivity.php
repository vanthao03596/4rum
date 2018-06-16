<?php

namespace App\Traits;

use App\Activity;

trait RecordActivity

{
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}