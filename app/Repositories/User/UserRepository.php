<?php

namespace App\Repositories\User;

use App\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        return User::query()
            ->select([
                'id',
                'firstname',
                'lastname',
                'mobile_number',
                'email'
            ])
            ->where('id', Auth::id())
            ->get();
    }

    public function getDatatableData($request)
    {
        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

}
