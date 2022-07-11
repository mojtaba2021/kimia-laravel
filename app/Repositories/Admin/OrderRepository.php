<?php

namespace App\Repositories\Admin;

use App\Models\Course\Course;
use App\Models\Order\Order;
use Yajra\DataTables\Facades\DataTables;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        return Order::query()
            ->select([
                'id',
                'user_id',
                'orderable_id'
            ])
            ->with('courses')
            ->where('orderable_type', Course::class)
            ->get();
    }

    public function getDatatableData($request)
    {

        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('users', function (Order $order) {
                    return $order->users->email;
                })
                ->addColumn('courses', function (Order $order) {
                    return $order->courses->title;
                })
                ->toJson();
        }
    }
}
