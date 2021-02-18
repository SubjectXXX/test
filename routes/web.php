<?php

use Illuminate\Support\Facades\Redis;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$cache_seconds = 60;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/api/posts', function () use ($cache_seconds) {

    $posts = Cache::remember('posts', $cache_seconds, function () {
        return DB::table('posts')->get();
    });


    return $posts;
});

$router->get('/api/posts/{id}', function ($id) use ($cache_seconds) {

    $post = Cache::remember('post/'.$id, $cache_seconds, function () use ($id) {
        return DB::table('posts')->where('id', $id)->get();
    });

    return $post;
});
