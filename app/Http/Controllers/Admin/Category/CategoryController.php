<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Models\Category\Category;
use App\Repositories\Admin\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');

    }

    public function store(CategoryStoreRequest $request)
    {
        $category = $this->categoryRepository->store($request);
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $courses = $this->categoryRepository->update($request, $category);
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $this->categoryRepository->destroy($category);
        return redirect()->route('admin.categories.index');
    }
}
