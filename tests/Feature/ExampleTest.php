<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Reply;
use App\Thread;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    // use RefreshDatabase;
    // use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    // public function testBasicTest()
    // {
    //     $thread = Thread::create([
    //         'user_id' => 1,
    //         'channel_id' => 1,
    //         'title' => 'test',
    //         'replies_count' => 0,
    //         'body' => 'test'

    //     ]);
    //     $reply = Reply::create([
    //         'thread_id' => $thread->id,
    //         'user_id' => 1,
    //         'parent_id' => '',
    //         'message' => 'hello'
    //     ]);
    //     auth()->loginUsingId(2);
    //     $response = $this->delete('/replies/' . $reply->id);
    //     $response->assertStatus(403);
    //     // $this->assertDatabaseHas('channels', [
    //     // 	'name' => 'test'
    //     // ]);
    // }
    public function testRepliesCount()
    {
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->create([
            'thread_id' => $thread->id
        ]);
        dd($thread->id, $reply->thread_id);
        $this->assertEquals(1, $thread->replies_count);
        // $this->assertDatabaseHas('channels', [
        // 	'name' => 'test'
        // ]);
    }
}
