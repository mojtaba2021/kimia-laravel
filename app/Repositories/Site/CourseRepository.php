<?php

namespace App\Repositories\Site;

use App\Models\Course\Course;
use App\Models\Item\Item;
use App\Models\Order\Order;
use Illuminate\Support\Facades\Auth;

class CourseRepository
//    extends BaseRepository
{
//    public function __construct(Course $model)
//    {
//        $this->setModel($model);
//    }

    public function getAll()
    {
        return Course::query()
            ->select([
                'id',
                'title',
                'slug',
                'description',
                'actual_price',
                'discount_price',
                'view_count',
                'subscriber_count',
                'course_lang',
                'course_time',
                'course_size',
                'course_kind'
            ])
            ->where('is_active', 1)
//            ->with('videos')
            ->get();
    }

    public function getCourse($course)
    {
        return Course::query()
            ->select([
                'id',
                'title',
                'slug',
                'description',
                'actual_price',
                'discount_price',
                'view_count',
                'subscriber_count',
                'course_lang',
                'course_time',
                'course_size',
                'course_kind'
            ])
            ->where('slug', $course)
            ->where('is_active', 1)
//            ->with('videos')
            ->first();
    }

    public function getCourseSeason($course)
    {
        return Item::query()
            ->select([
                'id',
                'title',
                'is_free',
                'parent_id',
            ])
            ->where('course_id', $course->id)
            ->where('parent_id', 0)
            ->get();
    }

//    public function getVideos()
//    {
//        return Video::query()
//            ->select([
//                'url',
//                'videoable_is',
//                'videoable_tyoe'
//            ])
//            ->get();
//    }

    public function checkOrder($course)
    {
        $userId = Auth::id();
        return Order::query()
            ->select([
                'id',
            ])
            ->where('user_id', $userId)
            ->where('orderable_id', $course->id)
            ->first();
    }

}
