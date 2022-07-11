<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Repositories\User\OrderRepository;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        return view('user.orders.index');
    }
}
