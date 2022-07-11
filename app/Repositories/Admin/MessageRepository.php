<?php

namespace App\Repositories\Admin;

use App\Models\Message\Message;
use Yajra\DataTables\Facades\DataTables;

class MessageRepository
//    extends BaseRepository
{
//    public function __construct(Course $model)
//    {
//        $this->setModel($model);
//    }

    public function getAll()
    {
        return Message::query()
            ->select([
                'id',
                'name',
                'mobile_number',
                'email',
                'description'
            ])
            ->get();
    }

    public function getLatest()
    {
        return Message::query()
            ->select([
                'id',
                'name',
                'mobile_number',
                'email',
                'description'
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
                    $destroy = route('admin.messages.destroy', $row->id);
                    $c = csrf_field();
                    $m = method_field('DELETE');
                    return
                        "
                    <div class='d-flex justify-content-center'>
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

    public function destroy($message)
    {
        $message->delete();
    }

}
