<?php

namespace App\Repositories\Admin;

use App\Models\EducationalVideo\EducationalVideo;
use App\Models\Image\Image;
use App\Models\Video\Video;
use Yajra\DataTables\Facades\DataTables;

class EducationalVideoRepository extends BaseRepository
{
    public function __construct(EducationalVideo $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        return EducationalVideo::query()
            ->select([
                'id',
                'title',
                'youtube_link',
                'aparat_link',
                'is_active'
            ])
            ->get();

    }

    public function getLatest()
    {
        return EducationalVideo::query()
            ->select([
                'id',
                'title',
                'youtube_link',
                'aparat_link',
                'is_active'
            ])
            ->latest()
            ->paginate(10);

    }

    public function getDatatableData($request)
    {
        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('admin.educationalvideos.edit', $row->id);
                    $destroy = route('admin.educationalvideos.destroy', $row->id);
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
        $item = new EducationalVideo();
        $item->title = $request->input('title');
        $item->youtube_link = $request->input('youtube_link');
        $item->aparat_link = $request->input('aparat_link');
        $item->is_active = $request->input('is_active');
        $item->save();
        $image = new Image();
        $image->url = $request->input('url');
        $item->images()->save($image);
        return $item;
    }

    public function update($request, $educational)
    {
        $educational->title = $request->input('title');
        $educational->youtube_link = $request->input('youtube_link');
        $educational->aparat_link = $request->input('aparat_link');
        $educational->is_active = $request->input('is_active');
        $educational->save();
        $educational->images()->update(['url' => $request->input('url')]);
        return $educational;
    }

    public function destroy($educational)
    {
        $educational->delete();
    }
}
