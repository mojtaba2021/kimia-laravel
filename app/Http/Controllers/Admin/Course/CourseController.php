<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\CourseStoreRequest;
use App\Http\Requests\Admin\Post\PostUpdateRequest;
use App\Models\Course\Course;
use App\Models\Item\Item;
use App\Repositories\Admin\CourseRepository;

class CourseController extends Controller
{
    protected $courseRepository;

    public function __construct(CourseRepository $CourseRepository)
    {
        $this->courseRepository = $CourseRepository;
    }

    public function index()
    {
        return view('admin.courses.index');
    }

    public function create()
    {
        $categories = $this->courseRepository->getCategory();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(CourseStoreRequest $request)
    {
        $this->courseRepository->store($request);
        alert()->success("با تشکر", 'دوره ی مورد نظر با موفقیت ثبت شد');
        return redirect()->route('admin.courses.index');
    }

    public function show(Course $course, Item $item)
    {
        return view('admin.courses.show', compact('course', 'item'));
    }

    public function edit(Course $course)
    {
        $courseCategory = $course->categories->first();
        $courseVideo = $course->videos();
        $categories = $this->courseRepository->getCategory();
        return view('admin.courses.edit', compact('course', 'categories', 'courseCategory', 'courseVideo'));
    }

    public function update(PostUpdateRequest $request, Course $course)
    {
        $this->courseRepository->update($request, $course);
        alert()->success("با تشکر", 'دوره ی مورد نظر با موفقیت ویرایش شد');
        return redirect()->route('admin.courses.index');
    }

    public function destroy(Course $course)
    {
        $this->courseRepository->destroy($course);
        return redirect()->route('admin.courses.index');
    }
}
