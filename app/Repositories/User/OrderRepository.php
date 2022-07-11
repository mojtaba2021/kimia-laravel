<?php

namespace App\Repositories\User;

use App\Models\Course\Course;
use App\Models\Order\Order;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        $userId = Auth::id();
        return Order::query()
            ->select([
                'id',
                'user_id',
                'orderable_id'
            ])
            ->with('courses')
            ->where('user_id', $userId)
            ->where('orderable_type', Course::class)
            ->get();
    }

    public function getDatatableData($request)
    {
//        $this->orderRepository->getAll()->courses->title;

        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('courses', function (Order $order) {
                    return $order->courses->title;
                })
//                ->toJson()
                ->addColumn('action', function (Order $order) {
                    $show = route('site.courses.show', $order->courses->slug);
                    return "<div class='d-flex justify-content-center'>
                    <a href='{$show}' class='btn btn-outline-info btn-sm mx-2'>نمایش</a>
                    </div>";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
