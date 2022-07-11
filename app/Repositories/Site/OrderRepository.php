<?php

namespace App\Repositories\Site;

use App\Models\Course\Course;
use App\Models\Order\Order;
use App\Models\Transaction\Transaction;
use Illuminate\Support\Facades\Auth;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class OrderRepository
{
    public function request($request)
    {
        $loginId = Auth::user()->id;
        $loginEmail = Auth::user()->email;
        $loginPhone = Auth::user()->mobile_number;
        $courseId = $request->course_id;
        $course = $this->getCourse($courseId);
        if ($course->discount_price == 0 or $course->discount_price == null) {
            $credit = (int)$course->actual_price;
        } else {
            $credit = (int)$course->discount_price;
        }
        $invoice = new Invoice;
        $invoice->amount($credit);
        $invoice->detail(['mobile' => $loginPhone, 'email' => $loginEmail]);
        return Payment::purchase($invoice, function ($driver, $transactionId) use ($loginId, $credit, $courseId) {
            $transaction = $this->transactionStore($loginId, $transactionId, $credit, $courseId);
            session()->put(['transaction' => $transaction->id]);
        }
        );
    }

    public function callBack($transaction)
    {
        try {
            $receipt = Payment::amount($transaction->credit)->transactionId($transaction->transaction_id)->verify();
            $this->saveOrder($transaction);
            $this->transactionUpdate($transaction, $receipt);
            alert()->success('با تشکر', 'عملیات با موفقیت انجام شد');
        } catch (InvalidPaymentException $exception) {
            $message = $exception->getMessage();
            alert()->error('خطا', $message);
        }
    }


    public function getCourse($courseID)
    {
        return Course::query()
            ->select([
                'id',
                'actual_price',
                'discount_price'
            ])
            ->where('id', $courseID)
            ->first();
    }

    public function transactionStore($loginId, $transactionId, $credit, $courseId)
    {
        $transaction = new Transaction();
        $transaction->user_id = $loginId;
        $transaction->transaction_id = $transactionId;
        $transaction->credit = $credit;
        $transaction->course_id = $courseId;
        $transaction->pay_type = "zarinPal";
        $transaction->save();
        return $transaction;

    }

    public function getTransaction($transId)
    {
        return Transaction::query()
            ->select([
                'id',
                'user_id',
                'transaction_id',
                'credit',
                'course_id'
            ])
            ->where('id', $transId)
            ->first();
    }

    public function saveOrder($transaction)
    {
        $courseId = $transaction->course_id;
        $course = $this->getCourse($courseId);
        $order = new Order();
        $order->user_id = $transaction->user_id;
        $course->orders()->save($order);
    }

    public function transactionUpdate($transaction, $receipt)
    {
        $transaction->ref_id = $receipt->getReferenceId();
        $transaction->status = 1;
        $transaction->save();
    }

}
