<?php

namespace App\Http\Controllers\Site\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Site\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function request(Request $request)
    {
        $peyment = $this->orderRepository->request($request);
        return $peyment->pay()->render();
    }

    public function callback()
    {
        $transId = session()->get('transaction');
        session()->forget(['transaction']);
        $transaction = $this->orderRepository->getTransaction($transId);
        $this->orderRepository->callBack($transaction);

        return redirect()->route('user.orders.index');
    }

}
