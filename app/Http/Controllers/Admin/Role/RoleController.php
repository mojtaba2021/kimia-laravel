<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleStoreRequest;
use App\Http\Requests\Admin\Role\RoleUpdateRequest;
use App\Repositories\Admin\RoleRepository;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        return view('admin.roles.index');
    }

    public function create()
    {
        $permissions = $this->roleRepository->getPermissions();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        $this->roleRepository->store($request);
        alert()->success("با تشکر", 'نقش مورد نظر با موفقیت ثبت شد');
        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = $this->roleRepository->getPermissions();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $this->roleRepository->update($request, $role);
        alert()->success("با تشکر", 'نقش مورد نظر با موفقیت ویرایش شد');
        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        $this->roleRepository->destroy($role);
        return redirect()->route('admin.roles.index');
    }
}
