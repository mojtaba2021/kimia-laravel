<?php

use App\Models\Course\Course;
use App\Models\Post\Post;

function ctpn($str)
{
    $english = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $convertedStr = str_replace($english, $persian, $str);
    return $convertedStr;
}

function statistics($kind, $id)
{
    if ($kind == "course") {
        $course = Course::find($id);
        $newCount = $course->view_count + 1;
        $course->view_count = $newCount;
        $course->save();
    } elseif ($kind == "post") {
        $post = Post::find($id);
        $newCount = $post->view_count + 1;
        $post->view_count = $newCount;
        $post->save();
    }
}
