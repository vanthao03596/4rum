<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected $thread;
    public function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }
    use DatabaseTransactions, DatabaseMigrations;
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
    /** @test */
    function a_thread_has_a_path()
    {
        $thread = create('App\Thread');
        $this->assertEquals(
            "/threads/{$thread->channel->slug}/{$thread->slug}", $thread->path()
        );
    }
    /** @test */
    public function testRepliesCount()
    {
        $thread = create('App\Thread');
        $reply = create('App\Reply', [
            'thread_id' => $thread->id
        ]);
        $this->assertEquals(1, $thread->fresh()->replies_count);
    }
}
