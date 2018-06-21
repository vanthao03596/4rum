<?php

namespace App\Traits;

use App\Activity;

trait RecordActivity
{
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    protected static function bootRecordActivity()
    {
        foreach (static::getRecordEvent() as $event) {
            static::created(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => $this->user_id,
            'type' => $this->getActivityType($event),
        ]);
    }
    protected static function getRecordEvent()
    {
        return ['created'];
    }

    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }
}
