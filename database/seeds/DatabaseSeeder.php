<?php

use App\Channel;
use App\Favorite;
use App\Reply;
use App\Thread;
use App\User;
use App\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Thread::truncate();
        Channel::truncate();
        Favorite::truncate();
        User::truncate();
        Reply::truncate();
		Admin::create([
			'name' => 'Phạm Thảo',
			'email' => 'admin@test.com',
			'password' => bcrypt('secret'),
			'remember_token' => str_random(10)
		]);
        $users = factory('App\User', 50)->create();
        $users = User::all();
        $threads = factory('App\Thread', 40)->create();
        $threads->each(function ($thread) {
            factory('App\Reply', 30)->create([
                'thread_id' => $thread->id,
            ]);
        });
        $threads->each(function ($thread) use ($users) {
            for ($i = 0; $i < mt_rand(10, 20); $i++) {
                $thread->favorites()->create([
                    'user_id' => $users->random()->id
                ]);
            }
        });
        Reply::all()->each(function ($comment) use ($users) {
            for ($i = 0; $i < mt_rand(10, 20); $i++) {
                $comment->favorites()->create([
                    'user_id' => $users->random()->id
                ]);
            }
        });
    }
}
