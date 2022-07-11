<?php

namespace App\Http\Controllers\Site\Post;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use App\Repositories\Site\PostRepository;

class PostController extends Controller
{

    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->getPosts();
        $postCategories = $this->postRepository->postCategories();
        return view('site.posts.index', compact('posts', 'postCategories'));
    }

    public function categoryFilter($category)
    {
        $posts = $this->postRepository->getCategoryFilter($category);
        $postCategories = $this->postRepository->postCategories();
        return view('site.posts.index', compact('posts', 'postCategories'));
    }

    public function show(Post $post)
    {
        $postCategories = $this->postRepository->postCategories();
        statistics("post", $post->id);
        return view('site.posts.single', compact('post', 'postCategories'));
    }
}
