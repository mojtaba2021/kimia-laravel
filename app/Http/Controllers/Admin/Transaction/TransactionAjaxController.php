<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\TransactionRepository;
use Illuminate\Http\Request;

class TransactionAjaxController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    public function getDatatableData(Request $request)
    {
        return $this->transactionRepository->getDatatableData($request);
    }
}
