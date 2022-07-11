<?php

use App\Models\Image\Image;
use App\Models\Video\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/contact-us', function () {
    return view('site.contact-us.contact-us');
})->name('contact-us');

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//  guery for attach category to fake posts

Route::get('/query', function () {
    $posts = \App\Models\Post\Post::all();
    foreach ($posts as $post) {
        $post->categories()->attach(rand(1, 15));
    }
    return "query is finished";
});

//  guery for attach video to fake educationalVideo

Route::get('/query1', function () {
    $educationals = App\Models\EducationalVideo\EducationalVideo::all();
    foreach ($educationals as $educational) {
        $image = new Image();
        $image->url = "/storage/photos/51/111111 (1).jpg";
        $educational->images()->save($image);
    }
    return "query is finished1";
});

//  add video link to posts

Route::get('/query2', function () {
    $posts = App\Models\Post\Post::all();
    foreach ($posts as $post) {
        $image = new Image();
        $image->url = "/storage/photos/51/111111 (1).jpg";
        $post->images()->save($image);
    }
    return "query is finished2";
});

Route::get('/query3', function () {
    $posts = App\Models\Course\Course::all();
    foreach ($posts as $post) {
        $video = new Video();
        $video->url = "/storage/files/51/asli.mp4";
        $post->videos()->save($video);
        $post->categories()->attach(rand(1, 15));

        $image = new Image();
        $image->url = "/storage/photos/51/111111 (1).jpg";
        $post->images()->save($image);
    }
    return "query is finished3";
});

Route::get('/query4', function () {
    $posts = App\Models\Item\Item::all();
    foreach ($posts as $post) {
        $post->course_id = rand(1, 20);
        $post->parent_id = rand(0, 3);
        $post->save();
    }
    return "query is finished4";
});

Route::get('/query5', function () {
    $posts = App\Models\Item\Item::all();
    $id = 0;
    foreach ($posts as $post) {
        $video = new Video();
        $video->url = "/storage/files/51/" . $id . ".mp4";
        $post->videos()->save($video);
        $id++;
    }
    return "query is finished5";
});

Route::get('/test1', function () {
    $posts = App\Models\Post\Post::all();
    foreach ($posts as $post) {
        $post->created_at = Carbon::today()->subDays(rand(0, 365));
        $post->save();
    }
    return "query test finished";
});

Route::get('/test2', function () {
    $posts = App\Models\Course\Course::all();
    foreach ($posts as $post) {
        $post->created_at = Carbon::today()->subDays(rand(0, 365));
        $post->save();
    }
    return "query test finished";
});


require __DIR__ . '/auth.php';
