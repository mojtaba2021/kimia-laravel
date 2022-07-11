<?php

namespace App\Repositories\Admin;

use App\Models\Category\Category;
use App\Models\Image\Image;
use App\Models\Post\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        return Post::query()
            ->select([
                'id',
                'title',
                'slug',
                'description',
                'view_count',
                'is_active'
            ])
            ->get();
    }

    public function getLatest()
    {
        return Post::query()
            ->select([
                'id',
                'title',
                'slug',
                'description',
                'view_count',
                'is_active'
            ])
            ->latest()
            ->paginate(10);

    }

    public function getCategory()
    {
        return Category::query()
            ->select([
                'id',
                'title',
                'type'
            ])
            ->where('type', 2)
            ->orWhere('type', 3)
            ->get();
    }

    public function getDatatableData($request)
    {
        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('admin.posts.edit', $row->id);
                    $destroy = route('admin.posts.destroy', $row->id);
                    $c = csrf_field();
                    $m = method_field('DELETE');
                    return
                        "
                    <div class='d-flex justify-content-center'>
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

        $id = Auth::id();
        $item = new Post();
        $item->user_id = $id;
        $item->title = $request->input('title');
        $item->slug = SlugService::createSlug(Post::class, 'slug', $request->input('slug'));
        $item->description = $request->input('description');
        $item->view_count = $request->input('view_count');
        $item->is_active = $request->input('is_active');
        $item->save();

        $item->categories()->attach($request->input('category_id'));

        $image = new Image();
        $image->url = $request->input('url');
        $item->images()->save($image);


    }

    public function update($request, $post)
    {
        DB::beginTransaction();
        try {
            $post->title = $request->input('title');
            $post->slug = $request->input('slug');
            $post->description = $request->input('description');
            $post->view_count = $request->input('view_count');
            $post->is_active = $request->input('is_active');
            $post->save();
            $post->categories()->sync($request->input('category_id'));
            $post->images()->update(['url' => $request->input('url')]);
            DB::commit();
            return $post;
        } catch (\Exception $error) {
            DB::rollback();
            return $error;
        }
    }

    public function destroy($category)
    {
        $category->delete();
    }

}
