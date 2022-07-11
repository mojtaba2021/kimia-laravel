<?php

namespace App\Repositories\Admin;

use App\Models\Category\Category;
use App\Models\Course\Course;
use App\Models\Image\Image;
use App\Models\Item\Item;
use App\Models\Video\Video;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CourseRepository extends BaseRepository
{
    public function __construct(Course $model)
    {
        $this->setModel($model);
    }

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
                'is_active',
            ])->get();

    }

    public function getItems($course)
    {
        return Item::query()
            ->select([
                'id',
                'title',
                'is_free',
                'parent_id',
            ])
            ->where('course_id', $course)
            ->where('parent_id', 0)
            ->get();
    }

    public function getCategory()
    {
        return Category::query()
            ->select([
                'id',
                'title',
                'type'
            ])
            ->where('type', 1)
            ->get();
    }

    public function getDatatableData($request)
    {
        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $show = route('admin.courses.show', $row->id);
                    $edit = route('admin.courses.edit', $row->id);
                    $destroy = route('admin.courses.destroy', $row->id);
                    $c = csrf_field();
                    $m = method_field('DELETE');
                    return
                        "
                    <div class='d-flex justify-content-center'>
                    <a href='{$show}' class='btn btn-outline-primary btn-sm'>سر فصل ها</a>
                    <a href='{$edit}' class='btn btn-outline-info btn-sm mx-2'>ویرایش</a>
                    <form action='{$destroy}' method='POST' id='myForm'>
                    $c
                    $m
                    <button type='submit' onclick='fireSweetAlert(form); return false' class='btn btn-sm btn-outline-danger'>حذف</button>
                    </form>
                    </div>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getItemDatatableData($request, $course)
    {
        if ($request->ajax()) {
            $data = $this->getItems($course);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($course) {
                    $show = route('admin.courses.show', ['course' => $course, 'item' => $row->id]);
                    $edit = route('admin.items.edit', $row->id);
                    $destroy = route('admin.items.destroy', $row->id);
                    $c = csrf_field();
                    $m = method_field('DELETE');
                    return
                        "
                    <div class='d-flex justify-content-center'>
                    <a href='{$show}' class='btn btn-outline-primary btn-sm mx-2'>درس ها</a>
                    <a href='{$edit}' class='btn btn-outline-info btn-sm mx-2'>ویرایش</a>
                    <form action='{$destroy}' method='POST' id='myForm'>
                    $c
                    $m
                    <button type='submit' onclick='fireSweetAlert(form); return false' class='btn btn-sm btn-outline-danger'>حذف</button>
                    </form>
                    </div>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $item = new Course();
            $item->title = $request->input('title');
            $item->slug = SlugService::createSlug(Course::class, 'slug', $request->input('slug'));
            $item->description = $request->input('description');
            $item->actual_price = $request->input('actual_price');
            $item->discount_price = $request->input('discount_price');
            $item->is_active = $request->input('is_active');
            $item->course_lang = $request->input('course_lang');
            $item->course_time = $request->input('course_time');
            $item->course_size = $request->input('course_size');
            $item->course_kind = $request->input('course_kind');
            $item->save();
            $item->categories()->attach($request->input('category_id'));
            $image = new Image();
            $image->url = $request->input('image_url');
            $item->images()->save($image);
            $video = new Video();
            $video->url = $request->input('url');
            $item->videos()->save($video);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            return $error;
        }
    }

    public function update($request, $course)
    {
        DB::beginTransaction();
        try {
            $course->title = $request->input('title');
            $course->slug = $request->input('slug');
            $course->description = $request->input('description');
            $course->actual_price = $request->input('actual_price');
            $course->discount_price = $request->input('discount_price');
            $course->is_active = $request->input('is_active');
            $course->course_lang = $request->input('course_lang');
            $course->course_time = $request->input('course_time');
            $course->course_size = $request->input('course_size');
            $course->course_kind = $request->input('course_kind');
            $course->save();
            $course->categories()->sync($request->input('category_id'));
            $course->videos()->update(['url' => $request->input('url')]);
            $course->images()->update(['url' => $request->input('image_url')]);
            DB::commit();
            return $course;
        } catch (\Exception $error) {
            DB::rollback();
            return $error;
        }
    }

    public function destroy($course)
    {
        $course->delete();
    }
}
