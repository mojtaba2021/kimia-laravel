<?php

namespace App\Repositories\Admin;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        return Role::query()
            ->select([
                'id',
                'name',
                'display_name'
            ])
            ->get();
    }

    public function getPermissions()
    {
        return Permission::query()
            ->select([
                'id',
                'name',
                'display_name'
            ])
            ->get();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $role = new Role();
            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->guard_name = "web";
            $role->save();

            $permission = $request->except('_token', 'display_name', 'name');
            $role->givePermissionTo($permission);
            Artisan::call('cache:clear');
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            return $error;
        }
    }

    public function getDatatableData($request)
    {
        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('admin.roles.edit', $row->id);
                    $destroy = route('admin.roles.destroy', $row->id);
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

    public function update($request, $role)
    {
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->save();
        $permissions = $request->except('_token', 'display_name', 'name', '_method');
        $role->syncPermissions($permissions);
    }

    public function destroy($role)
    {
        $role->delete();
    }
}
