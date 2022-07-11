<?php

namespace App\Http\Controllers\Site\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Message\StoreMessageRequest;
use App\Repositories\Site\MessageRepository;

class MessageController extends Controller
{
    protected $MessageRepository;

    public function __construct(MessageRepository $MessageRepository)
    {
        $this->MessageRepository = $MessageRepository;
    }

    public function store(StoreMessageRequest $request)
    {
        $this->MessageRepository->store($request);
        alert()->success("با تشکر", 'پیام شما با موفقیت ارسال شد');
        return redirect()->back();
    }

}
