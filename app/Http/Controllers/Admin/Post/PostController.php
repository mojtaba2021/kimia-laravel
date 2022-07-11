<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\PostStoreRequest;
use App\Http\Requests\Admin\Post\PostUpdateRequest;
use App\Models\Post\Post;
use App\Repositories\Admin\PostRepository;

class PostController extends Controller
{
    protected $PostRepository;

    public function __construct(PostRepository $PostRepository)
    {
        $this->PostRepository = $PostRepository;
    }

    public function index()
    {
        return view('admin.posts.index');

    }

    public function create()
    {

        $categories = $this->PostRepository->getCategory();
        return view('admin.posts.create', compact('categories'));

    }

    public function store(PostStoreRequest $request)
    {
        $this->PostRepository->store($request);
        alert()->success("با تشکر", 'مقاله ی مورد نظر با موفقیت ثبت شد');
        return redirect()->route('admin.posts.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Post $post)
    {
        $postCategory = $post->categories->first();
        $categories = $this->PostRepository->getCategory();
        return view('admin.posts.edit', compact('post', 'categories', 'postCategory'));
    }

    public function update(PostUpdateRequest $request, Post $post)
    {

        $this->PostRepository->update($request, $post);
        alert()->success("با تشکر", 'مقاله ی مورد نظر با موفقیت ویرایش شد');
        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $this->PostRepository->destroy($post);
        return redirect()->route('admin.posts.index');
    }
}
