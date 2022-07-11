<?php

namespace App\Http\Controllers\User\Transaction;

use App\Http\Controllers\Controller;
use App\Repositories\User\TransactionRepository;

class TransactionController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        return view('user.transactions.index');
    }
}
