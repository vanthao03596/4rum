<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Activity
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subject
 */
	class Activity extends \Eloquent {}
}

namespace App{
/**
 * App\Channel
 *
 * @property-read string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Thread[] $threads
 */
	class Channel extends \Eloquent {}
}

namespace App{
/**
 * App\Favorite
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $favorited
 * @property-read \App\User $user
 */
	class Favorite extends \Eloquent {}
}

namespace App{
/**
 * App\Reply
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read \App\Channel $channel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Favorite[] $favorites
 * @property-read mixed $favorite_count
 * @property-read mixed $is_favorited
 * @property-read \App\User $owner
 * @property-read \App\Thread $thread
 */
	class Reply extends \Eloquent {}
}

namespace App{
/**
 * App\Thread
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read \App\Channel $channel
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Favorite[] $favorites
 * @property-read mixed $created_at
 * @property-read mixed $favorite_count
 * @property-read mixed $is_favorited
 * @property-read mixed $title
 * @property-read \App\Reply $latestReply
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reply[] $replies
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread filter($filter)
 */
	class Thread extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Favorite[] $favorites
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reply[] $replies
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Thread[] $threads
 */
	class User extends \Eloquent {}
}

