<?php

namespace App\Repositories\Admin;


use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        return Permission::query()
            ->select([
                'id',
                'name',
                'display_name'
            ])
            ->get();
    }

    public function getDatatableData($request)
    {
        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('admin.permissions.edit', $row->id);
                    $destroy = route('admin.permissions.destroy', $row->id);
                    $c = csrf_field();
                    $m = method_field('DELETE');
                    return
                        "
                    <div class='d-flex justify-content-center'>
                    <a href='{$edit}' class='btn btn-outline-info btn-sm mx-2'>ویرایش</a>
                    <form action='{$destroy}' method='POST' id='myForm'>
                    $c
                    $m
                    <button type='submit' onclick='fireSweetAlert(form); return false' class='btn btn-sm btn-outline-danger'>حذف</button>
                    </form>
                    </div>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store($request)
    {
        $item = new Permission();
        $item->name = $request->input('name');
        $item->display_name = $request->input('display_name');
        $item->guard_name = "web";
        $item->save();
    }

    public function update($request, $permission)
    {
        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->save();
    }

    public function destroy($permission)
    {
        $permission->delete();
    }
}
