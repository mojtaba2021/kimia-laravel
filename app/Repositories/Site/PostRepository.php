<?php

namespace App\Repositories\Site;

use App\Enums\ECategoryType;
use App\Models\Category\Category;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Builder;

class PostRepository
//    extends BaseRepository
{
//    public function __construct(Course $model)
//    {
//        $this->setModel($model);
//    }
    public function getPosts()
    {
        return Post::query()
            ->select([
                'id',
                'slug',
                'user_id',
                'title',
                'description',
                'created_at'
            ])
            ->where('is_active', 1)
            ->with(['images', 'users'])
            ->latest()
            ->paginate(10);
    }

    public function postCategories()
    {
        return Category::query()
            ->select([
                'id',
                'slug',
                'title',
                'type'
            ])
            ->where('type', ECategoryType::PHARMACOLOGY_POST)
            ->orWhere('type', ECategoryType::MEDICINAL_PLANTS_POST)
            ->get();
    }

    public function getCategoryFilter($category)
    {
        return Post::query()
            ->select([
                'id',
                'user_id',
                'title',
                'slug',
                'description'
            ])
            ->where('is_active', 1)
            ->whereHas('categories', function (Builder $query) use ($category) {
                $query->where('categories.slug', $category);
            })
            ->with(['images', 'users'])
            ->latest()
            ->paginate(10);
    }

}
