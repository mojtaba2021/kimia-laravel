<?php

namespace App\Repositories\Admin;


use App\Models\Course\Course;
use App\Models\Post\Post;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class SitemapRepository extends BaseRepository
{
    public function generate()
    {
//   return SitemapGenerator::create('http://127.0.0.1:8000')
//        ->writeToFile(public_path('sitemap.xml'));
        $sitemap = Sitemap::create()
            ->add(Url::create('/blog'))
            ->add(Url::create('/courses'));
        Course::where('is_active', 1)
            ->each(function (Course $course) use ($sitemap) {
                $sitemap->add(Url::create("/courses/" . $course->slug));
            });
        Post::where('is_active', 1)->each(function (Post $post) use ($sitemap) {
            $sitemap->add(Url::create("/blog/" . $post->slug));
        });
        return $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
