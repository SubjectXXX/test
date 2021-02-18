<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function test_all()
    {

        $this->get('/api/posts/');

        $this->assertEquals(
            DB::table('posts')->get(), $this->response->getContent()
        );

    }

    public function test_existing_id()
    {

        $count = DB::table('posts')->count();
        $random_id = rand(1, $count);

        $this->get('/api/posts/'.$random_id);

        $this->assertEquals(
            DB::table('posts')->where('id', $random_id)->get(), $this->response->getContent()
        );

    }

    public function test_unexisting_id()
    {

        $count = DB::table('posts')->count();
        $random_id = rand($count+1, $count + 100);

        $this->get('/api/posts/'.$random_id);

        $this->assertEquals(
            DB::table('posts')->where('id', $random_id)->get(), $this->response->getContent()
        );

    }

    public function test_cache_hit()
    {
        $count = DB::table('posts')->count();
        $random_id = rand(1, $count);

        $original_response = $this->get('/api/posts/'.$random_id)->response->getContent();;

        $original_value = DB::table('posts')->where('id', $random_id)->value('title');
        DB::table('posts')->where('id', $random_id)->update(['title'=>strrev($original_value)]);

        $modified_response = $this->get('/api/posts/'.$random_id)->response->getContent();

        DB::table('posts')->where('id', $random_id)->update(['title'=>$original_value]);

        $this->assertEquals(
            $original_response, $modified_response
        );

    }

    public function test_cache_miss()
    {
        $count = DB::table('posts')->count();
        $random_id = rand(1, $count);

        $original_response = $this->get('/api/posts/'.$random_id)->response->getContent();

        $original_value = DB::table('posts')->where('id', $random_id)->value('title');
        DB::table('posts')->where('id', $random_id)->update(['title'=>strrev($original_value)]);

        Cache::forget('post/'.$random_id);

        $modified_response = $this->get('/api/posts/'.$random_id)->response->getContent();

        DB::table('posts')->where('id', $random_id)->update(['title'=>$original_value]);

        $this->assertNotEquals(
            $original_response, $modified_response
        );

    }
}
