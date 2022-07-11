<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\PermissionRepository;
use Illuminate\Http\Request;

class PermissionAjaxController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    public function getDatatableData(Request $request)
    {
        return $this->permissionRepository->getDatatableData($request);
    }
}
