<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\PermissionStoreRequest;
use App\Http\Requests\Admin\Permission\PermissionUpdateRequest;
use App\Repositories\Admin\PermissionRepository;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        return view('admin.permissions.index');
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(PermissionStoreRequest $request)
    {
        $this->permissionRepository->store($request);
        alert()->success("با تشکر", 'دسترسی ی مورد نظر با موفقیت ثبت شد');
        return redirect()->route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',compact('permission'));
    }

    public function update(permissionUpdateRequest $request, Permission $permission)
    {
        $this->permissionRepository->update($request, $permission);
        alert()->success("با تشکر", 'دسترسی مورد نظر با موفقیت ویرایش شد');
        return redirect()->route('admin.permissions.index');
    }

    public function destroy(Permission $Permission)
    {
        $this->permissionRepository->destroy($Permission);
        return redirect()->route('admin.permissions.index');
    }
}
