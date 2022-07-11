<?php

namespace App\Http\Controllers\Admin\Message;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\MessageRepository;
use Illuminate\Http\Request;

class MessageAjaxController extends Controller
{
    protected $MessageRepository;

    public function __construct(MessageRepository $MessageRepository)
    {
        $this->MessageRepository = $MessageRepository;
    }
    public function getDatatableData(Request $request)
    {
        return $this->MessageRepository->getDatatableData($request);
    }
}
