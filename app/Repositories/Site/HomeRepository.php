<?php

namespace App\Repositories\Site;


use App\Enums\ECategoryType;
use App\Models\Course\Course;
use App\Models\EducationalVideo\EducationalVideo;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Builder;

class HomeRepository
//    extends BaseRepository
{
//    public function __construct(Course $model)
//    {
//        $this->setModel($model);
//    }
    public function getCourses()
    {
        return Course::query()
            ->select([
                'id',
                'title',
                'slug',
                'description',
                'actual_price',
                'discount_price'
            ])
            ->where('is_active', 1)
            ->with('images')
            ->get();
    }

    public function getPosts()
    {
        return Post::query()
            ->select([
                'id',
                'user_id',
                'slug',
                'title',
                'description'
            ])
            ->where('is_active', 1);

    }

    public function getEducatinalVideo()
    {
        return EducationalVideo::query()
            ->select([
                'id',
                'title',
                'youtube_link',
                'aparat_link',
                'is_active'
            ])
            ->with('images')
            ->where('is_active', 1)
            ->orderBy('id', 'ASC')
            ->get();
    }

    public function getPharmacologyPost()
    {
        return $this->getPosts()
            ->where('is_active', 1)
            ->whereHas('categories', function (Builder $query) {
                $query->where('type', ECategoryType::PHARMACOLOGY_POST);
            })
            ->with('images')
            ->limit(3)
            ->get();
    }

    public function getMedicinalPost()
    {
        return $this->getPosts()
            ->where('is_active', 1)
            ->whereHas('categories', function (Builder $query) {
                $query->where('type', ECategoryType::MEDICINAL_PLANTS_POST);
            })
            ->with('images')
            ->limit(3)
            ->get();
    }

}
