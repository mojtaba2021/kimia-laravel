<?php

namespace App\Http\Controllers\Admin\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Message\StoreMessageRequest;
use App\Http\Requests\Admin\Message\UpdateMessageRequest;
use App\Models\Message\Message;
use App\Repositories\Admin\MessageRepository;

class MessageController extends Controller
{
    protected $MessageRepository;

    public function __construct(MessageRepository $MessageRepository)
    {
        $this->MessageRepository = $MessageRepository;
    }

    public function index()
    {
        return view('admin.messages.index');

    }

    public function show($id)
    {
        //
    }

    public function destroy(Message $message)
    {
        $this->MessageRepository->destroy($message);
        return redirect()->route('admin.messages.index');
    }
}
