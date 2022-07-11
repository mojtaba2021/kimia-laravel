<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Repositories\User\OrderRepository;
use Illuminate\Http\Request;

class OrderAjaxController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function getDatatableData(Request $request)
    {
        return $this->orderRepository->getDatatableData($request);
    }
}
