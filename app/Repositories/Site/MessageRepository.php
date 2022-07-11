<?php

namespace App\Repositories\Site;

use App\Models\Message\Message;

class MessageRepository
//    extends BaseRepository
{
//    public function __construct(Course $model)
//    {
//        $this->setModel($model);
//    }

    public function store($request)
    {
        $item = new Message();
        $item->name = $request->input('name');
        $item->mobile_number = $request->input('mobile_number');
        $item->email = $request->input('email');
        $item->description = $request->input('description');
        $item->save();

    }

}
