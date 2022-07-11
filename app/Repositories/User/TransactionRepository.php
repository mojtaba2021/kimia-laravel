<?php

namespace App\Repositories\User;

use App\Models\Transaction\Transaction;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransactionRepository extends BaseRepository
{
    public function __construct(Transaction $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        $loginId = Auth::id();
        return Transaction::query()
            ->select([
                'id',
                'credit',
                'ref_id',
                'status'
            ])
            ->where('user_id', $loginId)
            ->get();
    }

    public function getDatatableData($request)
    {
        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()
//                ->addColumn('action', function ($row) {
//                    $edit = route('admin.posts.edit', $row->id);
//                    $destroy = route('admin.posts.destroy', $row->id);
//                    $c = csrf_field();
//                    $m = method_field('DELETE');
//                    return
//                        "
//                    <div class='d-flex justify-content-center'>
//                    <a href='{$edit}' class='btn btn-outline-info btn-sm mx-2'>ویرایش</a>
//                    <form action='{$destroy}' method='POST' id='myForm'>
//                    $c
//                    $m
//                    <button type='submit' onclick='fireSweetAlert(form); return false' class='btn btn-sm btn-outline-danger'>حذف</button>
//                    </form>
//                    </div>
//                    ";
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
