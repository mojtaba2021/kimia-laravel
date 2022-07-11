<?php

namespace App\Repositories\Admin;

use App\Enums\EItemType;
use App\Models\Course\Course;
use App\Models\Item\Item;
use App\Models\Video\Video;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class ItemRepository extends BaseRepository
{
    public function __construct(Item $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        return Item::query()
            ->select([
                'id',
                'course_id',
                'title',
                'description',
                'is_free',
                'parent_id',
            ])
            ->with('course')
            ->with('parent')
//            ->latest()
            ->get();
    }

    public function getItems($item)
    {
        return Item::query()
            ->select([
                'id',
                'title',
                'is_free',
                'parent_id',
            ])
            ->where('parent_id', '<>', 0)
            ->where('parent_id', $item)
            ->get();
    }

    public function getParentItems($course)
    {
        return Item::query()
            ->select([
                'id',
                'title'
            ])
            ->where('course_id', $course->id)
            ->where('parent_id', 0)
            ->get();
    }

    public function getCourse($item)
    {
        return Course::query()
            ->select([
                'id',
                'title',
            ])
            ->where('is_active', 1)
            ->where('id', $item->course_id)
            ->first();
    }

    public function storeSeason($request)
    {
        $course_id = $request->course;
        $latestSeason = count($this->getLatesSeason($course_id));
        $item = new Item();
        $item->course_id = $course_id;
        $item->title = $request->season;
        $item->parent_id = $request->parent_id;
        $item->sort = $latestSeason + 1;
        $item->save();
        return $item;
    }

    public function getLatesSeason($course)
    {
        return Item::query()
            ->where('parent_id', 0)
            ->Where('course_id', $course)
            ->orderBy('sort')
            ->get();
    }

    public function store($request)
    {
        if ($request->creative == 1) {
            return $this->storeSeason($request);
        } elseif ($request->creative == 2) {
            $course_id = $request->course;
            $count = $request->czContainer_czMore_txtCount;
            // return items in request that are arrays
            $items = collect($request->all())->filter(function ($value) {
                return is_array($value);
            })->toArray();
            //then store lessons
            for ($i = 0; $i < $count; $i++) {
                $item = new Item();
                $item->course_id = $course_id;
                $item->title = $items['title'][$i];
                $item->description = $items['description'][$i];
                $item->is_free = $items['is_free'][$i];
                $item->parent_id = $request->parent_id;
                $item->sort = $i + 1;
                $item->save();
                $video = new Video();
                $video->url = $items['url'][$i];
                $item->videos()->save($video);
            }
            return $item;
        }
    }

    public function getItemDatatableData($request, $item)
    {
        if ($request->ajax()) {
            $data = $this->getItems($item);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $edit = route('admin.items.edit', $row->id);
                    $destroy = route('admin.items.destroy', $row->id);
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

    public function update($request, $item)
    {
        if ($item->getRawOriginal('parent_id') == EItemType::SEASON) {
            $item->title = $request->input('title');
            $item->save();
            return $item;
        }
        DB::beginTransaction();
        try {
            $item->title = $request->input('title');
            $item->description = $request->input('description');
            $item->is_free = $request->input('is_free');
            $item->save();
            $item->videos()->update(['url' => $request->input('url')]);
            DB::commit();
            return $item;
        } catch (\Exception $error) {
            DB::rollback();
            return $error;
        }
    }

    public function destroy($item)
    {
        if ($item->videos())
            $item->videos()->delete();
        if ($item->getRawOriginal('parent_id') == EItemType::SEASON) {
            $item->children()->delete();
        }
        $item->delete();
        return $item;
    }
}
